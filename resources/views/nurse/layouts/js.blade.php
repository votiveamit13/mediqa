<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<style>
  .iti {
    display: block !important;
}
input.form-control.numbers.js_mobile_input {
    padding-left: 80px !important;
}
</style>
<script>
  $(document).ready(function() {
    /*------------------------------------------

       --------------------------------------------



       Country Dropdown Change Event

       --------------------------------------------

       --------------------------------------------*/
    $('#nurse_support').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 5
        }
      }
    })

    $(".need_support_btn").click(function() {
      $(".nurse_support_slider").toggle();
    });

    $('#countryI').on('change', function() {

      var idCountry = this.value;

      $("#stateI").html('');

      $.ajax({

        url: "{{url('fetch-provinces')}}",

        type: "POST",

        data: {

          country_id: idCountry,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(result) {

          $('#stateI').html('<option value=""> Select  State</option>');

          $.each(result.province, function(key, value) {

            $("#stateI").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });

          $('#cityI').html('<option value=""> Select City </option>');

        }

      });


    });

    $('#countryLicense').on('change', function() {

      var idCountry = this.value;

      $("#stateLicense").html('');

      $.ajax({

        url: "{{url('fetch-provinces')}}",

        type: "POST",

        data: {

          country_id: idCountry,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(result) {

          $('#stateLicense').html('<option value=""> Select  State</option>');

          $.each(result.province, function(key, value) {

            $("#stateLicense").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });



        }

      });


    });

    $('#countryworkprefer').on('change', function() {

      var idCountry = this.value;

      $("#stateworkprefer").html('');

      $.ajax({

        url: "{{url('fetch-provinces')}}",

        type: "POST",

        data: {

          country_id: idCountry,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(result) {

          $('#stateworkprefer').html('<option value=""> Select  State</option>');

          $.each(result.province, function(key, value) {

            $("#stateworkprefer").append('<option value="' + value

              .id + '">' + value.name + '</option>');

          });

          $('#cityI').html('<option value=""> Select City </option>');

        }

      });


    });

    /*------------------------------------------

    --------------------------------------------

    State Dropdown Change Event

    --------------------------------------------

    --------------------------------------------*/

    // $('#stateI').on('change', function() {

    //   var idState = this.value;

    //   $("#cityI").html('');

    //   $.ajax({

    //     url: "{{url('fetch-ville')}}",

    //     type: "POST",

    //     data: {

    //       province_id: idState,

    //       _token: '{{csrf_token()}}'

    //     },

    //     dataType: 'json',

    //     success: function(res) {

    //       $('#cityI').html('<option value=""> Select City </option>');

    //       $.each(res.ville, function(key, value) {

    //         $("#cityI").append('<option value="' + value

    //           .id + '">' + value.name + '</option>');

    //       });

    //     }

    //   });

    // });
    $('#categoryI').on('change', function() {

      var categoryI = this.value;

      $("#sub_cateI").html('');

      $.ajax({

        url: "{{url('fetch-sub-cat')}}",

        type: "POST",

        data: {

          category_id: categoryI,

          _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function(res) {


          $('#sub_cateI').html('<option value=""> Select Sub category </option>');

          $.each(res.sub_cat, function(key, value) {

            $("#sub_cateI").append('<option value="' + value

              .id + '">' + value.category_name + '</option>');

          });

        }

      });

    });


  });
</script>
<script>
  $('.numbers').keyup(function() {
    this.value = this.value.replace(/[^0-9\.]/g, '');
  });
  $('.licence_number').keyup(function() {
    this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
  });
</script>
<script type="text/javascript">
  $(function() {

    var targetDate = new Date(Date.UTC(2017, 3, 01));
    var now = new Date();

    window.days = daysBetween(now, targetDate);
    var secondsLeft = secondsDifference(now, targetDate);
    window.hours = Math.floor(secondsLeft / 60 / 60);
    secondsLeft = secondsLeft - (window.hours * 60 * 60);
    window.minutes = Math.floor(secondsLeft / 60);
    secondsLeft = secondsLeft - (window.minutes * 60);
    console.log(secondsLeft);
    window.seconds = Math.floor(secondsLeft);

    startCountdown();
  });
  var interval;

  function daysBetween(date1, date2) {
    //Get 1 day in milliseconds
    var one_day = 1000 * 60 * 60 * 24;

    // Convert both dates to milliseconds
    var date1_ms = date1.getTime();
    var date2_ms = date2.getTime();

    // Calculate the difference in milliseconds
    var difference_ms = date2_ms - date1_ms;

    // Convert back to days and return
    return Math.round(difference_ms / one_day);
  }

  function secondsDifference(date1, date2) {
    //Get 1 day in milliseconds
    var one_day = 1000 * 60 * 60 * 24;

    // Convert both dates to milliseconds
    var date1_ms = date1.getTime();
    var date2_ms = date2.getTime();
    var difference_ms = date2_ms - date1_ms;
    var difference = difference_ms / one_day;
    var offset = difference - Math.floor(difference);
    return offset * (60 * 60 * 24);
  }



  function startCountdown() {
    $('#input-container').hide();
    $('#countdown-container').show();

    displayValue('#js-days', window.days);
    displayValue('#js-hours', window.hours);
    displayValue('#js-minutes', window.minutes);
    displayValue('#js-seconds', window.seconds);

    interval = setInterval(function() {
      if (window.seconds > 0) {
        window.seconds--;
        displayValue('#js-seconds', window.seconds);
      } else {
        // Seconds is zero - check the minutes
        if (window.minutes > 0) {
          window.minutes--;
          window.seconds = 59;
          updateValues('minutes');
        } else {
          // Minutes is zero, check the hours
          if (window.hours > 0) {
            window.hours--;
            window.minutes = 59;
            window.seconds = 59;
            updateValues('hours');
          } else {
            // Hours is zero
            window.days--;
            window.hours = 23;
            window.minutes = 59;
            window.seconds = 59;
            updateValues('days');
          }
          // $('#js-countdown').addClass('remove');
          // $('#js-next-container').addClass('bigger');
        }
      }
    }, 1000);
  }


  function updateValues(context) {
    if (context === 'days') {
      displayValue('#js-days', window.days);
      displayValue('#js-hours', window.hours);
      displayValue('#js-minutes', window.minutes);
      displayValue('#js-seconds', window.seconds);
    } else if (context === 'hours') {
      displayValue('#js-hours', window.hours);
      displayValue('#js-minutes', window.minutes);
      displayValue('#js-seconds', window.seconds);
    } else if (context === 'minutes') {
      displayValue('#js-minutes', window.minutes);
      displayValue('#js-seconds', window.seconds);
    }
  }

  function displayValue(target, value) {
    var newDigit = $('<span></span>');
    $(newDigit).text(pad(value))
      .addClass('new');
    $(target).prepend(newDigit);
    $(target).find('.current').addClass('old').removeClass('current');
    setTimeout(function() {
      $(target).find('.old').remove();
      $(target).find('.new').addClass('current').removeClass('new');
    }, 900);
  }

  function pad(number) {
    return ("0" + number).slice(-2);
  }

  function preview_image_single_second()

  {

    $('#image_preview_div_single_second').show();

    var total_file = document.getElementById("upload_file_second").files.length;

    for (var i = 0; i < total_file; i++)

    {

      $('#image_preview_single_second').empty().append(
        "<ul><li class='position-relative img-li'><span class='position-absolute close-btn'></span><img src='" +
        URL.createObjectURL(event.target.files[i]) + "' class='rounded-circle' width='100' height='100'></li></ul><br>");

    }
    $('.pervious_image').hide();

  }
</script>

<script>
  function ChangePassword() {
    $.ajax({
      url: "{{route('nurse.change_password')}}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#ChangePassword')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#signup_btn').prop('disabled', true);
        $('#signup_btn').text('Process...');
      },
      success: function(data) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Change password');
        if (data.status == 1) {

          Swal.fire({
            icon: 'success',
            title: data.message,
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'Got It',
            denyButtonText: `Don't save`,
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          })

        } else {
          if (data.status == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.message,
            })
          } else {
            $('#old_pass').html(data.message);
            for (var err in data.validation) {

              $("#ChangePassword").find("[name='" + err + "']").after("<div  class='label alert-danger' style='color:red;'>" + data.validation[err] + "</div>");
            }
          }
        }
      },
      error: function(eror) {
        console.log(eror);
        for (var err in eror.responseJSON.errors) {

          $("#ChangePassword").find("[name='" + err + "']").after("<div  class='label alert-danger'>" + eror.responseJSON.errors[err] + "</div>");
        }
      }
    });
    return false;
  }
</script>
<script>
  function upload_profileimage(e) {

    e.preventDefault();
    $('#preloadeer-active').show();
    $('.alert-danger').remove();
    var fileInput = document.getElementById("fileInputs");

    if (fileInput.files.length > 0) {



      $.ajax({



        url: '{{route("nurse.user-upload-image")}}',



        type: 'POST',



        cache: false,



        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
        },



        processData: false,



        data: new FormData($('#upload_profileimage')[0]),



        dataType: 'json',



        beforeSend: function() {



          $('#sub_btn').prop('disabled', true);



          $('#php502').html('Uploading ...');







        },



        success: function(res) {



          $('#sub_btn').prop('disabled', false);







          if (res.status == 1) {



            window.location.reload();



          } else if (res.status == 2) {



            for (var err in res.message) {







              $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");



            }
            $('#preloadeer-active').hide();



          }







        }



      });



    } else {


      $('#preloadeer-active').hide();
      return false;



    }



  }
</script>
<script>
  function editedprofile() {
    $('#EditProfile').find('.text-danger').hide();

    $.ajax({
      url: "{{ route('nurse.updateProfile') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#EditProfile')[0]),
      dataType: 'json',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      beforeSend: function() {
        $('#submitfrm').prop('disabled', true);
        $('#submitfrm').text('Process....');
      },
      success: function(res) {
        $('#submitfrm').prop('disabled', false);
        $('#submitfrm').text('Update Profile');
        if (res.status == '2') {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Profile Updated Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.my-profile') }}?page=my_profile";
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: res.message,
          })
        }
      },
      error: function(errorss) {
        $('#submitfrm').prop('disabled', false);
        $('#submitfrm').text('Submit');
        for (var err in errorss.responseJSON.errors) {
          $("#EditProfile").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
        }
      }
    });
    return false;
  }



  //   function editedprofile() {

  //     let isValid = true;

  //     // Clear previous errors
  //     $('#EditProfile').find('.text-danger').text('');


  //       $('.registration-card').each(function () {

  //         const $card = $(this);
  //         const status = $card.find('.status-radio:checked').val();
  //         const isExisting = $card.data('existing') == 1;

  //         // Draft → skip
  //         if (status !== '3') return true;

  //         // Existing record → skip validation
  //         if (isExisting) return true;

  //         const jurisdiction = $card.find('.js_jurid_input');
  //         const regNumber    = $card.find('.js_reg_number');
  //         const expiryDate   = $card.find('.js_expiry_date');
  //         const evidence     = $card.find('.js_evidence')[0];

  //         const errJur  = $card.find('.reqTxtjurisd');
  //         const errReg  = $card.find('.reqTxtReg');
  //         const errExp  = $card.find('.reqTxtExpiry');
  //         const errFile = $card.find('.reqTxtEvidence');

  //         if (!jurisdiction.val().trim()) {
  //             errJur.text('* Jurisdiction is required');
  //             isValid = false;
  //         }

  //         if (!regNumber.val().trim()) {
  //             errReg.text('* Registration Number is required');
  //             isValid = false;
  //         }

  //         if (!expiryDate.val()) {
  //             errExp.text('* Expiry Date is required');
  //             isValid = false;
  //         } else {
  //             const selected = new Date(expiryDate.val());
  //             const today = new Date();
  //             today.setHours(0,0,0,0);

  //             if (selected < today) {
  //                 errExp.text('* Expiry Date cannot be in the past');
  //                 isValid = false;
  //             }
  //         }

  //         if (!evidence || evidence.files.length === 0) {
  //             errFile.text('* Upload Evidence is required');
  //             isValid = false;
  //         }
  //     });


  //     // ❌ Stop AJAX if validation failed
  //     if (!isValid) {
  //         $('html, body').animate({
  //             scrollTop: $('.text-danger:visible:first').offset().top - 120
  //         }, 400);
  //         return false;
  //     }

  //     // ✅ AJAX submit
  //     $.ajax({
  //         url: "{{ url('/nurse/updateProfile') }}",
  //         type: "POST",
  //         cache: false,
  //         contentType: false,
  //         processData: false,
  //         data: new FormData($('#EditProfile')[0]),
  //         dataType: 'json',
  //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
  //         beforeSend: function () {
  //             $('#submitfrm').prop('disabled', true).text('Processing...');
  //         },
  //         success: function (res) {
  //             $('#submitfrm').prop('disabled', false).text('Update Profile');
  //             if (res.status == '2') {
  //                 Swal.fire({
  //                     icon: 'success',
  //                     title: 'Success',
  //                     text: 'Profile Updated Successfully',
  //                 }).then(() => {
  //                     window.location.href = "{{ route('nurse.my-profile') }}?page=my_profile";
  //                 });
  //             } else {
  //                 Swal.fire({
  //                     icon: 'error',
  //                     title: 'Error',
  //                     text: res.message,
  //                 });
  //             }
  //         },
  //         error: function(errorss) {
  //             $('#submitfrm').prop('disabled', false).text('Submit');

  //             // Clear old errors
  //             $("#EditProfile .text-danger").remove();

  //             $.each(errorss.responseJSON.errors, function (field, messages) {
  //                 // Convert dot notation to bracket notation
  //                 // Example: registration.68.jurisdiction → registration[68][jurisdiction]
  //                 let parts = field.split('.');
  //                 let inputName = parts.shift(); // "registration"
  //                 while (parts.length) {
  //                     inputName += '[' + parts.shift() + ']';
  //                 }

  //                 // Find the input
  //                 let input = $("#EditProfile").find("[name='" + inputName + "']");

  //                 if (input.length) {
  //                     $.each(messages, function (i, msg) {
  //                         input.after("<div class='text-danger'>" + msg + "</div>");
  //                     });
  //                 } else {
  //                     // fallback: show at top if input not found
  //                     $("#countryError").append("<div class='text-danger'>" + messages[0] + "</div>");
  //                 }
  //             });
  //         }
  //     });

  //     return false;
  // }
  function myFunction1() {
    event.preventDefault();
    var isValid = true;




    if ($('.nurse_type_field').val() == '') {
      document.getElementById("reqnurseTypeId").innerHTML = "* Please select the type of nurse";
      isValid = false;
    }

    $(".subnurse_list").each(function() {
      var val = $(this).val();
      //var subpartsval = $(".subspecprofpart_list-"+val).val();
      console.log("subnurse_list",val);
      if ($('.subnurse_valid-'+val).val() == '0') {
        document.getElementById("reqsubnursevalid-"+val).innerHTML = "* Please select the type of nurse";
        isValid = false;
      }



    });

    $(".subspecnurse_list").each(function() {
        var val_spec = $(this).val();
        //var subpartsval = $(".subspecprofpart_list-"+val).val();
        console.log("subspec_list",val_spec);
        if ($('.js-example-basic-multiple'+val_spec+"-0").val() == '0') {
          document.getElementById("reqspecialties"+val_spec+"-0").innerHTML = "* Please select the Specialties";
          isValid = false;
        }

        $(".subspec_list").each(function() {
          var val_subspec = $(this).val();
          //var subpartsval = $(".subspecprofpart_list-"+val).val();
          console.log("subspec_list",val_subspec);
          if ($('.js-example-basic-multiple'+val_spec+"-"+val_subspec).val() == '0') {
            document.getElementById("reqsubspecvalid"+val_spec+"-"+val_subspec).innerHTML = "* Please select the Specialties";
            isValid = false;
          }

        });

        $(".subspecprof_list").each(function() {
          var val_subspec_status = $(this).val();
          //var subpartsval = $(".subspecprofpart_list-"+val).val();
          console.log("val_subspec_status",val_subspec_status);
          if ($('.speciality_status_valid-'+val_spec+"-"+val_subspec_status).val() == '') {
            document.getElementById("reqsubspecstatusvalid"+val_spec+"-"+val_subspec_status).innerHTML = "* Please select the Specialty Status";
            isValid = false;
          }

          if ($('.experience_level-'+val_spec+"-"+val_subspec_status).val() == '') {
            document.getElementById("reqassistentlevel"+val_spec+"-"+val_subspec_status).innerHTML = "* Please select the overall experience";
            isValid = false;
          }

          if ($('.employee_status-'+val_spec+"-"+val_subspec_status).val() == '') {
            document.getElementById("reqemployee_status"+val_spec+"-"+val_subspec_status).innerHTML = "* Please select the Current Employment Status";
            isValid = false;
          }

          if ($('.professional_permanent-'+val_spec+"-"+val_subspec_status).is(':hidden') == false) {
            //alert('.js-example-basic-multipleper'+val_spec+"-"+val_subspec_status);
            if ($('.js-example-basic-multipleper'+val_spec+"-"+val_subspec_status).val() == 'select') {

              document.getElementById("reqemployeep_status"+val_spec+"-"+val_subspec_status).innerHTML = "* Please select the Permanent Employment Status";
              isValid = false;
            }
          }

          if ($('.professional_temporary-'+val_spec+"-"+val_subspec_status).is(':hidden') == false) {
            if ($('.js-example-basic-multiple'+val_spec+"-"+val_subspec_status).val() == 'select') {
              document.getElementById("reqemployeet_status"+val_spec+"-"+val_subspec_status).innerHTML = "* Please select the Temporary Employment Status";
              isValid = false;
            }
          }

          if ($('.professional_unemplyeed-'+val_spec+"-"+val_subspec_status).is(':hidden') == false) {
            if ($('.unemployeement_reason-'+val_spec+"-"+val_subspec_status).val() == '') {
              document.getElementById("requnempreason-"+val_spec+"-"+val_subspec_status).innerHTML = "* Please select the Reason for Unemployment";
              isValid = false;
            }
          }

          if ($('.long_unemplyeed-'+val_spec+"-"+val_subspec_status).is(':hidden') == false) {
            if ($('.long_unemployeed-'+val_spec+"-"+val_subspec_status).val() == '') {
              document.getElementById("reqlong_unemp"+val_spec+"-"+val_subspec_status).innerHTML = "* Please select the Reason for Unemployment Period";
              isValid = false;
            }
          }

          if ($('.specify_reason_div-'+val_spec+"-"+val_subspec_status).is(':hidden') == false) {
            if ($('.specify_reason_div-'+val_spec+"-"+val_subspec_status+' input').val() == '') {
              document.getElementById("otherspecify_reason"+val_spec+"-"+val_subspec_status).innerHTML = "* Please enter the Other (Please specify)";
              isValid = false;
            }
          }
        });

      });

      if ($('[name="bio"]').val() == '') {
        document.getElementById("reqprofessional_bio").innerHTML = "* Please enter the bio.";
        isValid = false;
      }

      if ($('[name="career_advancement_goals"]').val() == '') {
        document.getElementById("reqcareergoals").innerHTML = "* Please enter the Career Advancement Goals";
        isValid = false;
      }

      if ($(".declare_information").prop('checked') == false) {
        document.getElementById("reqdeclare_information").innerHTML = "* Please check this checkbox";
        isValid = false;
      }

    if (isValid == true) {
      $.ajax({
        url: "{{ route('nurse.updateProfession') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#profession_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitProfession').prop('disabled', true);
          $('#submitProfession').text('Process....');
        },
        success: function(res) {
          $('#submitProfession').prop('disabled', false);
          $('#submitProfession').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Professional Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=profession";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitProfession').prop('disabled', false);
          $('#submitProfession').text('Submit');
          for (var err in errorss.responseJSON.errors) {
            $("#submitProfession").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }



  function educert() {
    var isValid = true;
    if ($('[name="ndegree[]"]').val() == '') {
      document.getElementById("reqdegree").innerHTML = "* Please select degree.";
      isValid = false;
    }

    if ($('[name="institution"]').val() == '') {

      document.getElementById("reqinstitute").innerHTML = "* Please enter the institutions.";
      isValid = false;
    }
    if ($('[name="graduation_start_date"]').val() == '') {
      document.getElementById("reqstartdate").innerHTML = "* Please enter the graduation start date.";
      isValid = false;
    }
    if ($('[name="graduation_end_date"]').val() == '') {
      document.getElementById("reqenddate").innerHTML = "* Please enter the graduation end date.";
      isValid = false;
    }
    if ($('[name="professional_certification[]"]').val() == '') {
      document.getElementById("reqcertificate").innerHTML = "* Please select professional certificate";
      isValid = false;
    }
    if ($('[name="license_number"]').val() == '') {
      document.getElementById("reqlicensenum").innerHTML = "* Please enter license number";
      isValid = false;
    }

    if ($(".procertdiv").hasClass("d-none") == false) {
      if ($('[name="acls_data[]"]').val() == '') {
        document.getElementById("reqaclsvalid").innerHTML = "* Please select ACLS (Advanced Cardiovascular Life Support)";
        isValid = false;
      }
    }

    // if ($('[name="training_courses[]"]').val() == '') {
    //   document.getElementById("reqaddtraining").innerHTML = "* Please select training courses";
    //   isValid = false;
    // }
    // if ($('[name="training_workshop[]"]').val() == '') {
    //   document.getElementById("reqaddworkshops").innerHTML = "* Please select training workshops";
    //   isValid = false;
    // }
    var i = 0;
    $(".acls_license_number").each(function() {

      if ($(".acls_license_number-" + i).length > 0) {
        if ($(".acls_license_number-" + i).val() == '') {
          document.getElementById("reqaclslicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".aclsexpiry").each(function() {

      if ($(".aclsexpiry-" + j).length > 0) {
        if ($(".aclsexpiry-" + j).val() == '') {
          document.getElementById("reqaclsexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });
    var k = 0;

    // $(".acls_upload_certification").each(function(){

    //   console.log("acls_upload_certification",$(".acls_licence_img-"+k).length);
    //   if($(".acls_licence_img-"+k).length == 0){
    //     if ($(".acls_upload_certification-"+k).length > 0) {
    //       if ($(".acls_upload_certification-"+k).val() == '') {
    //         document.getElementById("reqaclsuploadvalid-"+k).innerHTML = "* Please add the license image";
    //         isValid = false;
    //       }
    //     }
    //   }
    //   k++;
    // });


    if ($(".procertdivone").hasClass("d-none") == false) {
      if ($('[name="bls_data[]"]').val() == '') {
        document.getElementById("reqblsvalid").innerHTML = "* Please select BLS (Basic Life Support)";
        isValid = false;
      }
    }
    var i = 0;
    $(".bls_license_number").each(function() {

      if ($(".bls_license_number-" + i).length > 0) {
        if ($(".bls_license_number-" + i).val() == '') {
          document.getElementById("reqblslicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".blsexpiry").each(function() {

      if ($(".blsexpiry-" + j).length > 0) {
        if ($(".blsexpiry-" + j).val() == '') {
          document.getElementById("reqblsexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivtwo").hasClass("d-none") == false) {
      if ($('[name="cpr_data[]"]').val() == '') {
        document.getElementById("reqcprvalid").innerHTML = "* Please select CPR (Cardiopulmonary Resuscitation)";
        isValid = false;
      }
    }
    var i = 0;
    $(".cpr_license_number").each(function() {

      if ($(".cpr_license_number-" + i).length > 0) {
        if ($(".cpr_license_number-" + i).val() == '') {
          document.getElementById("reqcprlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".cprexpiry").each(function() {

      if ($(".cprexpiry-" + j).length > 0) {
        if ($(".cprexpiry-" + j).val() == '') {
          document.getElementById("reqcprexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivthree").hasClass("d-none") == false) {
      if ($('[name="nrp_data[]"]').val() == '') {
        document.getElementById("reqnrpvalid").innerHTML = "* Please select NRP (Neonatal Resuscitation Program)";
        isValid = false;
      }
    }
    var i = 0;
    $(".nrp_license_number").each(function() {

      if ($(".nrp_license_number-" + i).length > 0) {
        if ($(".nrp_license_number-" + i).val() == '') {
          document.getElementById("reqnrplicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".nrpexpiry").each(function() {

      if ($(".nrpexpiry-" + j).length > 0) {
        if ($(".nrpexpiry-" + j).val() == '') {
          document.getElementById("reqnrpexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivfour").hasClass("d-none") == false) {
      if ($('[name="pls_data[]"]').val() == '') {
        document.getElementById("reqplsvalid").innerHTML = "* Please select PALS (Pediatric Advanced Life Support)";
        isValid = false;
      }
    }
    var i = 0;
    $(".pls_license_number").each(function() {

      if ($(".pls_license_number-" + i).length > 0) {
        if ($(".pls_license_number-" + i).val() == '') {
          document.getElementById("reqplslicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".plsexpiry").each(function() {

      if ($(".plsexpiry-" + j).length > 0) {
        if ($(".plsexpiry-" + j).val() == '') {
          document.getElementById("reqplsexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivfive").hasClass("d-none") == false) {
      if ($('[name="rn_data[]"]').val() == '') {
        document.getElementById("reqrnvalid").innerHTML = "* Please select RN (Registered Nurse)";
        isValid = false;
      }
    }
    var i = 0;
    $(".rn_license_number").each(function() {

      if ($(".rn_license_number-" + i).length > 0) {
        if ($(".rn_license_number-" + i).val() == '') {
          document.getElementById("reqrnlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".rnexpiry").each(function() {

      if ($(".rnexpiry-" + j).length > 0) {
        if ($(".rnexpiry-" + j).val() == '') {
          document.getElementById("reqrnexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivtwelfth").hasClass("d-none") == false) {
      if ($('[name="np_data[]"]').val() == '') {
        document.getElementById("reqnpvalid").innerHTML = "* Please select NP (Nurse Practioner) / (APRN) Advanced Practice Registered Nurse";
        isValid = false;
      }
    }
    var i = 0;
    $(".np_license_number").each(function() {

      if ($(".np_license_number-" + i).length > 0) {
        if ($(".np_license_number-" + i).val() == '') {
          document.getElementById("reqnplicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".npexpiry").each(function() {

      if ($(".npexpiry-" + j).length > 0) {
        if ($(".npexpiry-" + j).val() == '') {
          document.getElementById("reqnpexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivsix").hasClass("d-none") == false) {
      if ($('[name="cn_data[]"]').val() == '') {
        document.getElementById("reqcnvalid").innerHTML = "* Please select CNA (Certified Nursing Assistant) / EN (Enrolled Nurse)";
        isValid = false;
      }
    }
    var i = 0;
    $(".cn_license_number").each(function() {

      if ($(".cn_license_number-" + i).length > 0) {
        if ($(".cn_license_number-" + i).val() == '') {
          document.getElementById("reqcnlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".cnexpiry").each(function() {

      if ($(".cnexpiry-" + j).length > 0) {
        if ($(".cnexpiry-" + j).val() == '') {
          document.getElementById("reqcnexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivseven").hasClass("d-none") == false) {
      if ($('[name="lpn_data[]"]').val() == '') {
        document.getElementById("reqlpnvalid").innerHTML = "* Please select CNA (Certified Nursing Assistant) / EN (Enrolled Nurse)";
        isValid = false;
      }
    }
    var i = 0;
    $(".lpn_license_number").each(function() {

      if ($(".lpn_license_number-" + i).length > 0) {
        if ($(".lpn_license_number-" + i).val() == '') {
          document.getElementById("reqlpnlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".lpnexpiry").each(function() {

      if ($(".lpnexpiry-" + j).length > 0) {
        if ($(".lpnexpiry-" + j).val() == '') {
          document.getElementById("reqlpnexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdiveight").hasClass("d-none") == false) {
      if ($('[name="crn_data[]"]').val() == '') {
        document.getElementById("reqcrnavalid").innerHTML = "* Please select CRNA (Certified Registered Nurse Anesthetist)";
        isValid = false;
      }
    }
    var i = 0;
    $(".crna_license_number").each(function() {

      if ($(".crna_license_number-" + i).length > 0) {
        if ($(".crna_license_number-" + i).val() == '') {
          document.getElementById("reqcrnalicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".crnaexpiry").each(function() {

      if ($(".crnaexpiry-" + j).length > 0) {
        if ($(".crnaexpiry-" + j).val() == '') {
          document.getElementById("reqcrnaexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivnine").hasClass("d-none") == false) {
      if ($('[name="cnm_data[]"]').val() == '') {
        document.getElementById("reqcnmvalid").innerHTML = "* Please select CNM (Certified Nurse Midwife)";
        isValid = false;
      }
    }
    var i = 0;
    $(".cnm_license_number").each(function() {

      if ($(".cnm_license_number-" + i).length > 0) {
        if ($(".cnm_license_number-" + i).val() == '') {
          document.getElementById("reqcnmlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".cnmexpiry").each(function() {

      if ($(".cnmexpiry-" + j).length > 0) {
        if ($(".cnmexpiry-" + j).val() == '') {
          document.getElementById("reqcnmexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivten").hasClass("d-none") == false) {
      if ($('[name="ons_data[]"]').val() == '') {
        document.getElementById("reqonsvalid").innerHTML = "* Please select ONS/ONCC (Oncology Nursing Society/Oncology Nursing Certification Corporation)";
        isValid = false;
      }
    }
    var i = 0;
    $(".ons_license_number").each(function() {

      if ($(".ons_license_number-" + i).length > 0) {
        if ($(".ons_license_number-" + i).val() == '') {
          document.getElementById("reqonslicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".onsexpiry").each(function() {

      if ($(".onsexpiry-" + j).length > 0) {
        if ($(".onsexpiry-" + j).val() == '') {
          document.getElementById("reqonsexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdiveleven").hasClass("d-none") == false) {
      if ($('[name="msw_data[]"]').val() == '') {
        document.getElementById("reqmswvalid").innerHTML = "* Please select MSW/AiM (Maternity Support Worker/Assistant in Midwifery ) / Midwife Assistant";
        isValid = false;
      }
    }
    var i = 0;
    $(".msw_license_number").each(function() {

      if ($(".msw_license_number-" + i).length > 0) {
        if ($(".msw_license_number-" + i).val() == '') {
          document.getElementById("reqmswlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".mswexpiry").each(function() {

      if ($(".mswexpiry-" + j).length > 0) {
        if ($(".mswexpiry-" + j).val() == '') {
          document.getElementById("reqmswexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivthirteen").hasClass("d-none") == false) {
      if ($('[name="ain_data[]"]').val() == '') {
        document.getElementById("reqainvalid").innerHTML = "* Please select AIN (Assistant in Nursing) / NA (Nurse Associate) / HCA (Healthcare Assistant)";
        isValid = false;
      }
    }
    var i = 0;
    $(".ain_license_number").each(function() {

      if ($(".ain_license_number-" + i).length > 0) {
        if ($(".ain_license_number-" + i).val() == '') {
          document.getElementById("reqainlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".ainexpiry").each(function() {

      if ($(".ainexpiry-" + j).length > 0) {
        if ($(".ainexpiry-" + j).val() == '') {
          document.getElementById("reqainexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    if ($(".procertdivfourteen").hasClass("d-none") == false) {
      if ($('[name="rpn_data[]"]').val() == '') {
        document.getElementById("reqrpnvalid").innerHTML = "* Please select RPN (Registered Practical Nurse) / RGN (Registered General Nurse)";
        isValid = false;
      }
    }
    var i = 0;
    $(".rpn_license_number").each(function() {

      if ($(".rpn_license_number-" + i).length > 0) {
        if ($(".rpn_license_number-" + i).val() == '') {
          document.getElementById("reqrpnlicencevalid-" + i).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      i++;
    });
    var j = 0;
    $(".rpnexpiry").each(function() {

      if ($(".rpnexpiry-" + j).length > 0) {
        if ($(".rpnexpiry-" + j).val() == '') {
          document.getElementById("reqrpnexpiryvalid-" + j).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      j++;
    });

    var u = 1;
    $(".additional_certificate_field").each(function() {

      if ($(".additional_certificate_field-" + u).length > 0) {
        if ($(".additional_certificate_field-" + u).val() == '') {

          document.getElementById("reqcertname-" + u).innerHTML = "* Please enter the certificate name";
          isValid = false;
        }
      }
      u++;
    });

    var v = 1;
    $(".cert_licence_num").each(function() {

      if ($(".cert_licence_num-" + v).length > 0) {
        if ($(".cert_licence_num-" + v).val() == '') {
          document.getElementById("reqcertlicense-" + v).innerHTML = "* Please enter the license number";
          isValid = false;
        }
      }
      v++;
    });

    var w = 1;
    $(".cert_expiry").each(function() {

      if ($(".cert_expiry-" + w).length > 0) {
        if ($(".cert_expiry-" + w).val() == '') {
          document.getElementById("reqcertexpiry-" + w).innerHTML = "* Please enter the Expiry Date";
          isValid = false;
        }
      }
      w++;
    });

    var x = 1;
    $(".additional_regulating_body").each(function() {

      if ($(".additional_regulating_body-" + x).length > 0) {
        if ($(".additional_regulating_body-" + x).val() == '') {
          document.getElementById("reqcertregulating_body-" + x).innerHTML = "* Please enter the Regulating Body";
          isValid = false;
        }
      }
      x++;
    });

    if ($(".declare_information_edu").prop('checked') == false) {
      document.getElementById("reqdeclare_information1").innerHTML = "* Please check this checkbox";
      isValid = false;
    }

    var end_date = $('.graduation_end_date').val();
    var start_date = $('.graduation_start_date').val();


    if (end_date < start_date) {


      document.getElementById("reqenddate").innerHTML = "* End date should not less than start date";
      isValid = false;

    }

    if (end_date == start_date) {


      document.getElementById("reqenddate").innerHTML = "* End date should not equal to start date";
      isValid = false;

    }

    if (isValid == true) {
      $('#educert_form').find('.text-danger').hide();
      $(".declare_information_man").addClass("disabled").prop('checked', true);
      $.ajax({
        url: "{{ route('nurse.updateEducation') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#educert_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitEducation').prop('disabled', true);
          $('#submitEducation').text('Process....');
        },
        success: function(res) {
          $('#submitEducation').prop('disabled', false);
          $('#submitEducation').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Education Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=educert";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitEducation').prop('disabled', false);
          $('#submitEducation').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitEducation").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });

    }
    return false;
  }

 function updateExperience() {
    var isValid = true;

    var s = 1;
    $(".facworktype").each(function() {
      if ($(".facworktype-" + s).length > 0) {
        if ($(".facworktype-" + s).val() == '') {
          document.getElementById("reqfacworktype-" + s).innerHTML = "* Please select the Facility / Workplace Type";
          isValid = false;
        }
      }
      var t = 1;
      $(".wp_data-" + s + " .subwork_list-" + s).each(function() {
        var work_valid = $(this).val();
        console.log("work_valid", work_valid);
        var work_label = $(".work_label-" + s + work_valid).text();
        if ($(".work_valid-" + s + work_valid).length > 0) {
          if ($(".work_valid-" + s + work_valid).val() == '') {
            document.getElementById("reqsubwork-" + s + work_valid).innerHTML = "* Please select the " + work_label;
            isValid = false;
          }
        }

        var u = 0;
        $(".wp_data-" + s + " .subpwork_list-" + s).each(function() {
          var work_valid = $(this).val();
          console.log("work_valid", work_valid);
          var work_label = $(".pwork_label-" + s + work_valid).text();
          if ($(".pwork_valid-" + s + work_valid).length > 0) {
            if ($(".pwork_valid-" + s + work_valid).val() == '') {
              document.getElementById("reqsubpwork-" + s + work_valid).innerHTML = "* Please select the " + work_label;
              isValid = false;
            }
          }
          u++;
        });
        t++;
      });


      s++;
    });


    var o = 1;
    $(".facworkname").each(function() {
      if ($(".facworkname-" + o).length > 0) {
        if ($(".facworkname-" + o).val() == '') {
          document.getElementById("reqfaceworkname-" + o).innerHTML = "* Please enter the Facility / Workplace Name";
          isValid = false;
        }
      }
      o++;
    });

    var a = 1;
    $(".nurse_type_exp").each(function() {
      if ($(".nurse_type_exp_" + a).length > 0) {
        if ($(".nurse_type_exp_" + a).val() == '') {
          document.getElementById("reqnurseTypeexpId-" + a).innerHTML = "* Please select the type of nurse";
          isValid = false;
        }
      }
      a++;
    });

    // var x = 1;
    // $(".type_nurse_input").each(function(i,val) {


    //   $(".type_nurse_input-"+x).each(function(i,val) {
    //     var ntypeval = $(this).val();
    //     var st_value = x.toString()+ntypeval.toString();
    //     if($(".nursing_exps_"+st_value).hasClass("d-none") == false){

    //       console.log("st_value_exp",st_value);
    //       var label_name = $(".nursing_type_label-"+st_value).text();

    //       if ($(".subtype_nurses-" +st_value).val() == '') {
    //         document.getElementById("reqnsubtypenurse-" +st_value).innerHTML = "* Please select the "+label_name;
    //         isValid = false;
    //       }

    //     }
    //   });
    //   x++;
    // });

    // var y = 1;
    // $(".nurse_prac_valid").each(function(i,val) {
    //   if($(".np_submenu_experience_"+y).hasClass("d-none") == false){
    //     if ($(".nurse_prac_valid_"+y).val() == '') {
    //       document.getElementById("reqnp-" +y).innerHTML = "* Please select the Nurse Practitioner (NP)";
    //       isValid = false;
    //     }
    //     y++;
    //   }

    // });

    // var p = 1;
    // $(".neonatal_exp").each(function(i,val) {
    //   if($(".neonatal_row_exp_"+p).hasClass("d-none") == false){

    //     if ($(".neonatal_exp_"+p).val() == '') {
    //       document.getElementById("reqneonatal-"+p).innerHTML = "* Please select the Neonatal Care";
    //       isValid = false;
    //     }

    //   }
    //   p++;
    // });

    // var q = 1;
    // $(".surgicalobstrics").each(function(i,val) {
    //   if($(".surgicalobs_row_experience-"+q).hasClass("d-none") == false){

    //     if ($(".surgicalobstrics-"+q).val() == '') {
    //       document.getElementById("reqsurgicalobstrics-"+q).innerHTML = "* Please select the Surgical Obstetrics and Gynecology (OB/GYN)";
    //       isValid = false;
    //     }

    //   }
    //   q++;
    // });

    // var t = 1;
    // $(".reqlevelexp").each(function(i,val) {


    //     if ($(".reqlevelexp-"+t).val() == 'select') {
    //       document.getElementById("reqlevelexp-"+t).innerHTML = "* Please select the Level of experience in this specialty";
    //       isValid = false;
    //     }


    //   t++;
    // });

    // var z = 1;
    // $(".type_specialities_input").each(function(i,val) {


    //   $(".type_specialities_input-"+z).each(function(i,val) {
    //     var stypeval = $(this).val();
    //     var st_value = z.toString()+stypeval.toString();
    //     if($(".speciality_exps_"+st_value).hasClass("d-none") == false){

    //       console.log("x",st_value);
    //       var label_name = $(".speciality_name_label-"+st_value).text();

    //       if ($(".subspecialities-" +st_value).val() == '') {
    //         document.getElementById("reqnsubspecialities-" +st_value).innerHTML = "* Please select the "+label_name;
    //         isValid = false;
    //       }

    //     }
    //   });
    //   z++;
    // });

    // var w = 1;
    // $(".surgicalp_input").each(function(i,val) {


    //   $(".surgicalp_input-"+w).each(function(i,val) {
    //     var stypeval = $(this).val();
    //     var st_value = w.toString()+stypeval.toString();
    //     console.log("stypeval",stypeval);
    //     if($(".surgicalp_experience-"+st_value).hasClass("d-none") == false){

    //       console.log("x",st_value);
    //       var label_name = $(".surgicalprelabel-"+st_value).text();

    //       if ($(".surgicalspec-" +st_value).val() == '') {
    //         document.getElementById("reqnsurgicalspecialities-" +st_value).innerHTML = "* Please select the "+label_name;
    //         isValid = false;
    //       }

    //     }
    //   });
    //   w++;
    // });

    // var u = 1;
    // $(".surgical_specialities_input").each(function(i,val) {


    //   $(".surgical_specialities_input-"+u).each(function(i,val) {
    //     var ntypeval = $(this).val();
    //     var st_value = u.toString()+ntypeval.toString();
    //     if($(".surgicalspeciality_exps_"+st_value).hasClass("d-none") == false){

    //       console.log("xsurgical",st_value);
    //       var label_name = $(".surgicalspeciality_name_label-"+st_value).text();

    //       if ($(".surgicalspecialities-" +st_value).val() == '') {
    //         document.getElementById("reqsurgicalspecialities-" +st_value).innerHTML = "* Please select the "+label_name;
    //         isValid = false;
    //       }

    //     }
    //   });
    //   u++;
    // });

    // var x = 1;
    // $(".padsurgical_specialities_input").each(function(i,val) {


    //   $(".padsurgical_specialities_input-"+x).each(function(i,val) {
    //     var ntypeval = $(this).val();
    //     var st_value = x.toString()+ntypeval.toString();
    //     if($(".padsurgicalspeciality_exps_"+st_value).hasClass("d-none") == false){


    //       var label_name = $(".padsurgicalspeciality_name_label-"+st_value).text();

    //       if ($(".padsurgicalspecialities-"+st_value).val() == '') {
    //         console.log("xsurgicalpad",st_value);
    //         document.getElementById("reqpadsurgicalspecialities-"+st_value).innerHTML = "* Please select the "+label_name;
    //         isValid = false;
    //       }

    //     }
    //   });
    //   x++;
    // });



    if ($(".exp_declare_information").prop('checked') == false) {
      document.getElementById("reqdeclare_information_exp").innerHTML = "* Please check this checkbox";
      isValid = false;
    }


    // var b = 1;
    // $(".spec_exp").each(function() {
    //   if ($(".spec_exp_" + b).length > 0) {
    //     if ($(".spec_exp_" + b).val() == '') {
    //       document.getElementById("reqspecialtiesexp-" + b).innerHTML = "* Please select the specialties";
    //       isValid = false;
    //     }
    //   }
    //   b++;
    // });


    // var c = 1;
    // $(".pos_held").each(function() {
    //   if ($(".pos_held_" + c).length > 0) {
    //     if ($(".pos_held_" + c).val() == '') {
    //       document.getElementById("reqpositionheld-" + c).innerHTML = "* Please select the position held";
    //       isValid = false;
    //     }
    //   }

    //   var r = 1;
    //   $(".show_positions-"+c+" .subpos_list").each(function() {
    //     var subpos = $(this).val();

    //     var label_text = $(".pos_label-"+ c+subpos).text();
    //     console.log("subpos",c+subpos);
    //     if ($(".position_valid-" + c+subpos).length > 0) {

    //       if ($(".position_valid-" + c+subpos).val() == '') {

    //         document.getElementById("reqsubpositionheld-" + c+subpos).innerHTML = "* Please select the "+label_text;
    //         isValid = false;
    //       }
    //     }
    //     r++;
    //   });
    //   c++;
    // });

    // var d = 1;
    // $(".employeement_start_date_exp").each(function() {
    //   if ($(".employeement_start_date_exp-" + d).length > 0) {
    //     if ($(".employeement_start_date_exp-" + d).val() == '') {
    //       document.getElementById("reqempsdateexp-" + d).innerHTML = "* Please enter the employment start date";
    //       isValid = false;
    //     }
    //   }
    //   d++;
    // });

    // var e = 1;
    // $(".employeement_end_date_exp").each(function() {
    //   if ($(".empl_end_date-" + e).is(':visible') == true) {
    //     if ($(".employeement_end_date_exp-" + e).val() == '') {
    //       document.getElementById("reqemployeementenddateexp-" + e).innerHTML = "* Please enter the employment end date";
    //       isValid = false;
    //     }
    //   }
    //   e++;
    // });

    var f = 1;
    $(".res-exp").each(function() {
      if ($(".res-exp-" + f).length > 0) {
        if ($(".res-exp-" + f).val() == '') {
          document.getElementById("reqresposiblitiesexp-" + f).innerHTML = "* Please enter the responsibilities";
          isValid = false;
        }
      }
      f++;
    });

    var g = 1;
    $(".ach_exp").each(function() {
      if ($(".ach_exp-" + g).length > 0) {
        if ($(".ach_exp-" + g).val() == '') {
          document.getElementById("reqachievementsexp-" + g).innerHTML = "* Please enter the achievements";
          isValid = false;
        }
      }
      g++;
    });


    var h = 1;
    $(".spe_skill").each(function() {
      if ($(".spe_skill_" + h).length > 0) {
        if ($(".spe_skill_" + h).val() == '') {
          document.getElementById("reqexpertiseexp-" + h).innerHTML = "* Please select the specific skills and competencies";
          isValid = false;
        }
      }
      h++;
    });

    var i = 1;
    $(".spe_skill").each(function() {
      if ($(".spe_skill_" + i).length > 0) {
        if ($(".spe_skill_" + i).val() == '') {
          document.getElementById("reqexpertiseexp-" + i).innerHTML = "* Please select the specific skills and competencies";
          isValid = false;
        }
      }
      var u = 1;
      $(".area_skills-" + i).each(function() {
        var val = $(this).val();
        var label = $(".analy_skill_label-" + i + val).text();
        console.log("val", val);
        if ($(".analy_skill_" + i + val).hasClass("d-none") == false) {
          if ($(".spc_comp-" + i + val).val() == '') {
            document.getElementById("reqanaskills-" + i + val).innerHTML = "* Please select the " + label;
            isValid = false;
          }
        }

        u++;
      });
      i++;
    });




    var j = 1;
    $(".type_of_evi").each(function() {
      if ($(".type_of_evi_" + j).length > 0) {
        if ($(".type_of_evi_" + j).val() == '') {
          document.getElementById("reqtype_evidenceexp-" + j).innerHTML = "* Please select the type of evidence";
          isValid = false;
        }
      }
      j++;
    });


    // var k = 1;
    // $(".emp_exp_type").each(function() {
    //   if ($(".emp_exp_type-" + k).length > 0) {
    //     if ($(".emp_exp_type-" + k).val() == '') {
    //       document.getElementById("reqemptype-" + k).innerHTML = "* Please select the employment type";
    //       isValid = false;
    //     }
    //   }
    //   k++;
    // });

    // var x = 1;
    // $(".permanent_exp").each(function() {
    //   if ($(".permanent_exp-" + x).length > 0 && $(".exp_permanent-" + x).is(":visible") == true) {

    //     if ($(".permanent_exp-" + x).val() == 'select') {

    //       document.getElementById("reqemployeep_statusexp-" + x).innerHTML = "* Please select the Permanent Status";
    //       isValid = false;
    //     }
    //   }
    //   x++;
    // });

    // var y = 1;
    // $(".temporary_exp").each(function() {
    //   if ($(".temporary_exp-" + y).length > 0 && $(".exp_temporary-" + y).is(":visible") == true) {

    //     if ($(".temporary_exp-" + y).val() == 'select') {

    //       document.getElementById("reqemployeetexp_status-" + y).innerHTML = "* Please select the Temporary Status";
    //       isValid = false;
    //     }
    //   }
    //   y++;
    // });

    // $(".speciality_status_column").each(function () {

    //   if ($(this).is(":visible") && $(this).val() === "") {

    //     var subSpecId = $(this).attr("class").match(/speciality_status_column-(\d+)/);

    //     if (subSpecId && subSpecId[1]) {
    //       $("#reqemployeetexp_status-" + subSpecId[1])
    //         .html("* Please select Specialty Status");
    //     }

    //     isValid = false;
    //   }
    // });

    if (isValid == true) {
      $('#experience_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updateExperience') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#experience_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitExperience').prop('disabled', true);
          $('#submitExperience').text('Process....');
        },
        success: function(res) {
          $('#submitExperience').prop('disabled', false);
          $('#submitExperience').text('Update Experience');

          // if (res.status == '1') {
          //   Swal.fire({
          //     icon: 'success',
          //     title: 'Success',
          //     text: 'Experience Information Updated Successfully',
          //   }).then(function() {
          //     window.location.href = "{{ route('nurse.my-profile') }}?page=experience_info";
          //   });
          // } else {
          //   console.log(res);
          //   Swal.fire({
          //     icon: 'error',
          //     title: 'Error',
          //     text: res.message,
          //   })
          // }

          if (res.status == '1') {

            // Step 1: Ask first about adding referee
            Swal.fire({
              title: `Add a Referee?`,
              text: 'Would you like to add a referee for this experience?',
              icon: 'question',
              showCancelButton: true,
              confirmButtonText: 'Add Referee',
              cancelButtonText: 'Skip',
            }).then((result) => {

              if (result.isConfirmed) {

                // If user wants to add a referee → redirect immediately
                window.location.href =
                  "{{ route('nurse.my-profile') }}?page=reference_info&experience_id=" + res.experience_id;


              } else {

                // If user skipped → show success message, then redirect
                Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'Experience Information Updated Successfully',
                }).then(() => {
                  window.location.href =
                    "{{ route('nurse.my-profile') }}?page=experience_info";
                });

              }

            });

          } else {

            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            });

          }

        },
        error: function(errorss) {
          $('#submitExperience').prop('disabled', false);
          $('#submitExperience').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitExperience").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }

  function updateTraining() {
    event.preventDefault()
    var isValid = true;
    if ($('[name="mandatory_courses[]"]').val() == '') {
      document.getElementById("reqmantra").innerHTML = "*Please Select training";
      isValid = false;
    }
    if ($(".mandatory_tr_div_1").hasClass("d-none") == false) {
      if ($('[name="well_self_care_data[]"]').val() == '') {
        document.getElementById("reqwellself").innerHTML = "* Please Select Wellness And Self-Care.";
        isValid = false;
      }
    }

    var i = 0;
    $(".well_institution").each(function() {
      if ($(".well_institution-" + i).length > 0) {
        if ($(".well_institution-" + i).val() == '') {
          document.getElementById("wellinstitutionvalid-" + i).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      i++;
    });

    var j = 0;
    $(".well_institution").each(function() {
      if ($(".well_institution-" + j).length > 0) {
        if ($(".well_institution-" + j).val() == '') {
          document.getElementById("wellinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      j++;
    });
    var k = 0;
    $(".well_tra_start_date").each(function() {
      if ($(".well_tra_start_date-" + k).length > 0) {
        if ($(".well_tra_start_date-" + k).val() == '') {
          document.getElementById("well_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".well_tra_end_date").each(function() {
      if ($(".well_tra_end_date-" + l).length > 0) {
        if ($(".well_tra_end_date-" + l).val() == '') {
          document.getElementById("well_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
          isValid = false;
        }
      }
      l++;
    });
    var m = 0;
    $(".well_expiry").each(function() {
      if ($(".well_expiry-" + m).length > 0) {
        if ($(".well_expiry-" + m).val() == '') {
          document.getElementById("wellexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });
    if ($(".mandatory_tr_div_2").hasClass("d-none") == false) {
      if ($('[name="tech_innvo_health_data[]"]').val() == '') {
        document.getElementById("reqtechinno").innerHTML = "* Please Select Technology and Innovation in Healthcare";
        isValid = false;
      }
    }

    var i = 0;
    $(".tech_innvo_institution").each(function() {
      if ($(".tech_innvo-" + i).length > 0) {
        if ($(".tech_innvo-" + i).val() == '') {
          document.getElementById("techinnvoinstitutionvalid-" + i).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      i++;
    });

    var k = 0;
    $(".tech_innvo_tra_start_date").each(function() {
      if ($(".tech_innvo_tra_start_date-" + k).length > 0) {
        if ($(".tech_innvo_tra_start_date-" + k).val() == '') {
          document.getElementById("tech_innvo_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".tech_innvo_tra_end_date").each(function() {
      if ($(".tech_innvo_tra_end_date-" + l).length > 0) {
        if ($(".tech_innvo_tra_end_date-" + l).val() == '') {
          document.getElementById("tech_innvo_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
          isValid = false;
        }
      }
      l++;
    });
    var m = 0;
    $(".tech_innvo_expiry ").each(function() {
      if ($(".tech_innvo_expiry-" + m).length > 0) {
        if ($(".tech_innvo_expiry-" + m).val() == '') {
          document.getElementById("wellexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });

    if ($(".mandatory_tr_div_3").hasClass("d-none") == false) {
      if ($('[name="leader_pro_dev_data[]"]').val() == '') {
        document.getElementById("reqeaderpro").innerHTML = "*Please Select Leadership and Professional Development";
        isValid = false;
      }
    }
    var i = 0;
    $(".leader_pro_institution").each(function() {
      if ($(".leader_pro-" + i).length > 0) {
        if ($(".leader_pro-" + i).val() == '') {
          document.getElementById("leaderproinstivalid-" + i).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      i++;
    });
    var k = 0;
    $(".leader_pro_tra_start_date ").each(function() {
      if ($(".leader_pro_tra_start_date-" + k).length > 0) {
        if ($(".leader_pro_tra_start_date-" + k).val() == '') {
          document.getElementById("leader_pro_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".leader_pro_tra_end_date ").each(function() {
      if ($(".leader_pro_tra_end_date-" + l).length > 0) {
        if ($(".leader_pro_tra_end_date-" + l).val() == '') {
          document.getElementById("leader_pro_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
          isValid = false;
        }
      }
      l++;
    });
    var m = 0;
    $(".leader_pro_expiry").each(function() {
      if ($(".leader_pro_expiry-" + m).length > 0) {
        if ($(".leader_pro_expiry-" + m).val() == '') {
          document.getElementById("leaderproexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });
    if ($(".mandatory_tr_div_4").hasClass("d-none") == false) {
      if ($('[name="mid_spec_tra_data[]"]').val() == '') {
        document.getElementById("reqmidwifespe").innerHTML = "*Please Select Midwifery-Specific Training";
        isValid = false;
      }
    }
    var i = 0;
    $(".mid_spec_institution").each(function() {
      if ($(".mid_spec-0-" + i).length > 0) {
        if ($(".mid_spec-0-" + i).val() == '') {
          document.getElementById("midspecinstivalid-" + i).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      i++;
    });


    var k = 0;
    $(".mid_spec_tra_start_date ").each(function() {
      if ($(".mid_spec_tra_start_date-" + k).length > 0) {
        if ($(".mid_spec_tra_start_date-" + k).val() == '') {
          document.getElementById("mid_spec_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".mid_spec_tra_end_date ").each(function() {
      if ($(".mid_spec_tra_end_date-" + l).length > 0) {
        if ($(".mid_spec_tra_end_date-" + l).val() == '') {
          document.getElementById("mid_spec_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
          isValid = false;
        }
      }
      l++;
    });
    var m = 0;
    $(".mid_spec_expiry").each(function() {
      if ($(".mid_spec_expiry-" + m).length > 0) {
        if ($(".mid_spec_expiry-" + m).val() == '') {
          document.getElementById("midspecexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });
    if ($(".mandatory_tr_div_5").hasClass("d-none") == false) {
      if ($('[name="clinic_skill_core_data[]"]').val() == '') {
        document.getElementById("reqcliniskill").innerHTML = "*Please Select Clinical Skills and Core Competencies";
        isValid = false;
      }
    }

    var i = 0;
    $(".clinic_skill_institution").each(function() {
      if ($(".clinic_skill-" + i).length > 0) {
        if ($(".clinic_skill-" + i).val() == '') {
          document.getElementById("cliskillinstivalid-" + i).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      i++;
    });


    var k = 0;
    $(".clinic_skill_tra_start_date ").each(function() {
      if ($(".clinic_skill_tra_start_date-" + k).length > 0) {
        if ($(".clinic_skill_tra_start_date-" + k).val() == '') {
          document.getElementById("clinic_skill_tra_start_datevalid-" + k).innerHTML = "* Please enter the training start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".clinic_skill_tra_end_date ").each(function() {
      if ($(".clinic_skill_tra_end_date-" + l).length > 0) {
        if ($(".clinic_skill_tra_end_date-" + l).val() == '') {
          document.getElementById("clinic_skill_tra_end_datevalid-" + l).innerHTML = "* Please enter the training end date";
          isValid = false;
        }
      }
      l++;
    });
    var m = 0;
    $(".clinic_skill_expiry").each(function() {
      if ($(".clinic_skill_expiry-" + m).length > 0) {
        if ($(".clinic_skill_expiry-" + m).val() == '') {
          document.getElementById("clinicskillexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });

    var n = 1;
    $(".additional_tra_field").each(function() {
      if ($(".additional_tra_field-" + n).length > 0) {
        if ($(".additional_tra_field-" + n).val() == '') {
          document.getElementById("reqtraname-" + n).innerHTML = "* Please enter the training name";
          isValid = false;
        }
      }
      n++;
    });

    var o = 1;
    $(".institution").each(function() {

      if ($(".institution-" + o).length > 0) {
        if ($(".institution-" + o).val() == '') {
          document.getElementById("reqinstitution-" + o).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      o++;
    });

    var p = 1;
    $(".tra_start_date").each(function() {

      if ($(".tra_start_date-" + p).length > 0) {
        if ($(".tra_start_date-" + p).val() == '') {
          document.getElementById("reqtrastartdate-" + p).innerHTML = "* Please enter the Training Start Date";
          isValid = false;
        }
      }
      p++;
    });

    var q = 1;
    $(".tra_end_date").each(function() {

      if ($(".tra_start_date-" + q).length > 0) {
        if ($(".tra_end_date-" + q).val() == '') {
          document.getElementById("reqtraenddate-" + q).innerHTML = "* Please enter the Training End Date";
          isValid = false;
        }
      }
      q++;
    });

    var r = 1;
    $(".tra_expiry").each(function() {

      if ($(".tra_expiry-" + r).length > 0) {
        if ($(".tra_expiry-" + r).val() == '') {
          document.getElementById("reqtra_expiry-" + r).innerHTML = "* Please enter the Expiry Date";
          isValid = false;
        }
      }
      q++;
    });

    if ($('[name="mandatory_education[]"]').val() == '') {
      document.getElementById("reqmanedu").innerHTML = "*Please Select continuing education";
      isValid = false;
    }

    if ($(".mandatory_sub_edu_div_5").hasClass("d-none") == false) {
      if ($('[name="emerging_topic[]"]').val() == '') {
        document.getElementById("reqemrtopic").innerHTML = "* Please Select Emerging Topics and Continuing Education";
        isValid = false;
      }
    }



    var j = 0;
    $(".eme_topic_institution ").each(function() {
      if ($(".eme_topic_institution-" + j).length > 0) {
        if ($(".eme_topic_institution-" + j).val() == '') {
          document.getElementById("emetopicinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      j++;
    });
    var k = 0;
    $(".eme_topic_start_date").each(function() {
      if ($(".eme_topic_start_date-" + k).length > 0) {
        if ($(".eme_topic_start_date-" + k).val() == '') {
          document.getElementById("eme_topic_start_datevalid-" + k).innerHTML = "* Please enter the start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".eme_topic_end_date").each(function() {
      if ($(".eme_topic_end_date-" + l).length > 0) {
        if ($(".eme_topic_end_date-" + l).val() == '') {
          document.getElementById("eme_topic_end_datevalid-" + l).innerHTML = "* Please enter the end date";
          isValid = false;
        }
      }
      l++;
    });

    var m = 0;
    $(".eme_topic_expiry").each(function() {
      if ($(".eme_topic_expiry-" + m).length > 0) {
        if ($(".eme_topic_expiry-" + m).val() == '') {
          document.getElementById("emetopicexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });
    var n = 0;
    $(".eme_topic_status").each(function() {
      if ($(".eme_topic_status-" + n).length > 0) {
        if ($(".eme_topic_status-" + n).val() == '') {
          document.getElementById("eme_topic_statusvalid-" + n).innerHTML = "* Please select status";
          isValid = false;
        }
      }
      n++;
    });

    if ($(".mandatory_sub_edu_div_4").hasClass("d-none") == false) {
      if ($('[name="safety_com[]"]').val() == '') {
        document.getElementById("reqsafety").innerHTML = "* Please Select Safety and Compliance Training";
        isValid = false;
      }
    }

    var j = 0;
    $(".safety_com_institution ").each(function() {
      if ($(".safety_com_institution-" + j).length > 0) {
        if ($(".safety_com_institution-" + j).val() == '') {
          document.getElementById("safetycominstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      j++;
    });
    var k = 0;
    $(".safety_com_start_date").each(function() {
      if ($(".safety_com_start_date-" + k).length > 0) {
        if ($(".safety_com_start_date-" + k).val() == '') {
          document.getElementById("safety_com_start_datevalid-" + k).innerHTML = "* Please enter the start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".safety_com_end_date").each(function() {
      if ($(".safety_com_end_date-" + l).length > 0) {
        if ($(".safety_com_end_date-" + l).val() == '') {
          document.getElementById("safety_com_end_datevalid-" + l).innerHTML = "* Please enter the end date";
          isValid = false;
        }
      }
      l++;
    });

    var m = 0;
    $(".safety_com_expiry").each(function() {
      if ($(".safety_com_expiry-" + m).length > 0) {
        if ($(".safety_com_expiry-" + m).val() == '') {
          document.getElementById("safetycomexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });
    var n = 0;
    $(".safety_com_status").each(function() {
      if ($(".safety_com_status-" + n).length > 0) {
        if ($(".safety_com_status-" + n).val() == '') {
          document.getElementById("safety_com_statusvalid-" + n).innerHTML = "* Please select status";
          isValid = false;
        }
      }
      n++;
    });

    if ($(".mandatory_sub_edu_div_2").hasClass("d-none") == false) {
      if ($('[name="mid_spe_mandotry[]"]').val() == '') {
        document.getElementById("reqmidspe").innerHTML = "* Please Select Midwifery-Specific Mandatory Continuing Education";
        isValid = false;
      }
    }

    var j = 0;
    $(".mid_spe_institution").each(function() {
      if ($(".mid_spe_institution-" + j).length > 0) {
        if ($(".mid_spe_institution-" + j).val() == '') {
          document.getElementById("midspeinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      j++;
    });
    var k = 0;
    $(".mid_spe_start_date").each(function() {
      if ($(".mid_spe_start_date-" + k).length > 0) {
        if ($(".mid_spe_start_date-" + k).val() == '') {
          document.getElementById("mid_spe_start_datevalid-" + k).innerHTML = "* Please enter the start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".mid_spe_end_date").each(function() {
      if ($(".mid_spe_end_date-" + l).length > 0) {
        if ($(".mid_spe_end_date-" + l).val() == '') {
          document.getElementById("mid_spe_end_datevalid-" + l).innerHTML = "* Please enter the end date";
          isValid = false;
        }
      }
      l++;
    });

    var m = 0;
    $(".mid_spe_expiry").each(function() {
      if ($(".mid_spe_expiry-" + m).length > 0) {
        if ($(".mid_spe_expiry-" + m).val() == '') {
          document.getElementById("midspeexpiryvalid-" + m).innerHTML = "* Please enter the expiry date";
          isValid = false;
        }
      }
      m++;
    });
    var n = 0;
    $(".mid_spe_status").each(function() {
      if ($(".mid_spe_status-" + n).length > 0) {
        if ($(".mid_spe_status-" + n).val() == '') {
          document.getElementById("mid_spe_statusvalid-" + n).innerHTML = "* Please select status";
          isValid = false;
        }
      }
      n++;
    });

    if ($(".mandatory_sub_edu_div_3").hasClass("d-none") == false) {
      if ($('[name="spec_area[]"]').val() == '') {
        document.getElementById("reqspecarea").innerHTML = "* Please Select Specialized Areas";
        isValid = false;
      }
    }
    var j = 0;
    $(".spec_area_institution ").each(function() {
      if ($(".spec_area_institution-" + j).length > 0) {
        if ($(".spec_area_institution-" + j).val() == '') {
          document.getElementById("specareainstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      j++;
    });
    var k = 0;
    $(".spec_area_start_date").each(function() {
      if ($(".spec_area_start_date-" + k).length > 0) {
        if ($(".spec_area_start_date-" + k).val() == '') {
          document.getElementById("spec_area_start_datevalid-" + k).innerHTML = "* Please enter the start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".spec_area_end_date").each(function() {
      if ($(".spec_area_end_date-" + l).length > 0) {
        if ($(".spec_area_end_date-" + l).val() == '') {
          document.getElementById("spec_area_end_datevalid-" + l).innerHTML = "* Please enter the end date";
          isValid = false;
        }
      }
      l++;
    });

    var m = 0;
    $(".spec_area_status").each(function() {
      if ($(".spec_area_status-" + m).length > 0) {
        if ($(".spec_area_status-" + m).val() == '') {
          document.getElementById("spec_area_statusvalid-" + m).innerHTML = "*Please select status ";
          isValid = false;
        }
      }
      m++;
    });
    var n = 0;
    $(".spec_area_expiry").each(function() {
      if ($(".spec_area_expiry-" + n).length > 0) {
        if ($(".spec_area_expiry-" + n).val() == '') {
          document.getElementById("specareaexpiryvalid-" + n).innerHTML = "*Please enter the expiry date";
          isValid = false;
        }
      }
      n++;
    });

    if ($(".mandatory_sub_edu_div_1").hasClass("d-none") == false) {
      if ($('[name="core_man_con_data[]"]').val() == '') {
        document.getElementById("reqcoreman").innerHTML = "* Please Select Core Mandatory Continuing Education";
        isValid = false;
      }
    }


    var j = 0;
    $(".core_man_institution ").each(function() {
      if ($(".core_man_institution-" + j).length > 0) {
        if ($(".core_man_institution-" + j).val() == '') {
          document.getElementById("coreinstitutionvalid-" + j).innerHTML = "* Please enter the institution/regulating body";
          isValid = false;
        }
      }
      j++;
    });
    var k = 0;
    $(".coreman_start_date").each(function() {
      if ($(".coreman_start_date-" + k).length > 0) {
        if ($(".coreman_start_date-" + k).val() == '') {
          document.getElementById("coreman_start_datevalid-" + k).innerHTML = "* Please enter the start date";
          isValid = false;
        }
      }
      k++;
    });
    var l = 0;
    $(".coreman_end_date").each(function() {
      if ($(".coreman_end_date-" + l).length > 0) {
        if ($(".coreman_end_date-" + l).val() == '') {
          document.getElementById("coreman_end_datevalid-" + l).innerHTML = "* Please enter the end date";
          isValid = false;
        }
      }
      l++;
    });

    var m = 0;
    $(".coreman_status").each(function() {
      if ($(".coreman_status-" + m).length > 0) {
        if ($(".coreman_status-" + m).val() == '') {
          document.getElementById("coreman_statusvalid-" + m).innerHTML = "*Please select status";
          isValid = false;
        }
      }
      m++;
    });
    var n = 0;
    $(".core_man_expiry ").each(function() {
      if ($(".core_man_expiry-" + n).length > 0) {
        if ($(".core_man_expiry-" + n).val() == '') {
          document.getElementById("coremanexpiryvalid-" + n).innerHTML = "*Please enter the expiry date";
          isValid = false;
        }
      }
      n++;
    });
    if ($(".declare_information_man").prop('checked') == false) {
      document.getElementById("reqmantradeclare_information").innerHTML = "* Please check this checkbox";
      isValid = false;
    }

    if (isValid == true) {
      $('#training_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updateTraining') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#training_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitTraining').prop('disabled', true);
          $('#submitTraining').text('Process....');
        },
        success: function(res) {
          $('#submitTraining').prop('disabled', false);
          $('#submitTraining').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Training Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=mandatory_training";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitTraining').prop('disabled', false);
          $('#submitTraining').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitExperience").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;

  }

    function updateReference() {
    event?.preventDefault();
    isValid = true;
    var i = 1;
    $(".first_name").each(function() {
      if ($(".first_name-" + i).length > 0) {
        console.log("first_name-" + i, $(".first_name-" + i).val());
        if ($(".first_name-" + i).val() == '') {
          document.getElementById("reqfname-" + i).innerHTML = "* Please enter the reference First Name";
          isValid = false;
        }
      }
      i++;

    });
    var j = 1;
    $(".last_name").each(function() {
      if ($(".last_name-" + j).length > 0) {
        console.log("last_name-" + j, $(".last_name-" + j).val());
        if ($(".last_name-" + j).val() == '') {
          document.getElementById("reqlname-" + j).innerHTML = "* Please enter the reference Last Name";
          isValid = false;
        }
      }
      j++;

    });

    var k = 1;
    $(".reference_email").each(function() {
      if ($(".reference_email-" + k).length > 0) {
        console.log("reference_email-" + k, $(".reference_email-" + k).val());
        if ($(".reference_email-" + k).val() == '') {
          document.getElementById("reqemail-" + k).innerHTML = "* Please enter the reference email";
          isValid = false;
        }
      }
      k++;

    });

    var l = 1;
    $(".phone_no").each(function() {
      if ($(".phone_no-" + l).length > 0) {
        console.log("phone_no-" + l, $(".phone_no-" + l).val());
        if ($(".phone_no-" + l).val() == '') {
          document.getElementById("reqphoneno-" + l).innerHTML = "* Please enter the reference phone no";
          isValid = false;
        }
      }
      l++;

    });

    var m = 1;
    $(".reference_relationship").each(function() {
      if ($(".reference_relationship-" + m).length > 0) {
        console.log("reference_relationship-" + m, $(".reference_relationship-" + m).val());
        if ($(".reference_relationship-" + m).val() == '') {
          document.getElementById("reqreferencerel-" + m).innerHTML = "* Please enter the reference relationship";
          isValid = false;
        }
      }
      m++;

    });

    var c = 1;
    $(".pos_heldr").each(function() {
      if ($(".pos_heldr_" + c).length > 0) {
        if ($(".pos_heldr_" + c).val() == '') {
          document.getElementById("reqposworked-" + c).innerHTML = "* Please select your position when you worked with this referee?";
          isValid = false;
        }
      }

      var r = 1;
      $(".show_positionsr-"+c+" .subpos_list").each(function() {
        var subpos = $(this).val();

        var label_text = $(".show_positionsr-"+c+" .pos_label-"+ c+subpos).text();
        console.log("subpos",c+subpos);
        if ($(".position_validr-" + c+subpos).length > 0) {

          if ($(".position_validr-" + c+subpos).val() == '') {

            document.getElementById("reqsubpositionheldr-" + c+subpos).innerHTML = "* Please select the "+label_text;
            isValid = false;
          }
        }
        r++;
      });
      c++;
    });

    var a = 1;

    $(".end_date").each(function () {

        // 🔹 detect if referee is linked to experience
        var isLinked = $('.exp-id-input-' + a).val() != 0;

        // 🔹 detect if experience is current
        var isCurrent = $('.still_working1-' + a).val() == 1;

        // ✅ If linked + current → DO NOT validate end date
        if (isLinked && isCurrent) {
            a++;
            return; // skip validation safely
        }

        // normal validation
        if ($('.end_date-' + a).is(':visible')) {
            if ($(".end_date-" + a).val() == '') {
                document.getElementById("reqrefereeedate-" + a).innerHTML =
                    "* Please select the End Date";
                isValid = false;
            }
        }

        a++;
    });


    var n = 1;
    $(".worked_together").each(function() {
      if ($(".worked_together-" + n).length > 0) {
        console.log("worked_together-" + n, $(".worked_together-" + n).val());
        if ($(".worked_together-" + n).val() == '') {
          document.getElementById("reqworked_together-" + n).innerHTML = "* Please enter the reference relationship";
          isValid = false;
        }
      }
      n++;

    });
    const isChecked = $('.declare').prop('checked');
    if (!isChecked) {

      // If not checked, show an error message
      document.getElementById("reqreference").innerHTML = "* Please check this checkbox";
      //$('.declaration_bottom').find('#reqreference').text('You must declare that the information is true and correct.');
      isValid = false;
    }

    if (isValid == true) {
      $('#reference_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updateReference') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#reference_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitReferences').prop('disabled', true);
          $('#submitReferences').text('Process....');
        },
        success: function(res) {
          $('#submitReferences').prop('disabled', false);
          $('#submitReferences').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Reference Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=reference_info";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitReferences').prop('disabled', false);
          $('#submitReferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitReferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }

  function updateInterview() {
    var isValid = true;
    if ($('[name="interview_availablity"]').val() == '') {
      document.getElementById("reqinterviewdate").innerHTML = "* Please enter the interview availability";
      isValid = false;
    }

    if ($('[name="reference_name"]').val() == '') {
      document.getElementById("reqprofessionalnames").innerHTML = "* Please enter the references name";
      isValid = false;
    }

    if ($('[name="reference_email"]').val() == '') {
      document.getElementById("reference_email").innerHTML = "* Please enter the references email";
      isValid = false;
    }

    if ($('[name="reference_contact"]').val() == '') {
      document.getElementById("reqTxtreferencecontactI").innerHTML = "* Please enter the reference contact";
      isValid = false;
    }

    if ($('[name="reference_relationship"]').val() == '') {
      document.getElementById("reqprofessionalrelationship").innerHTML = "* Please select the reference relationship";
      isValid = false;
    }


    if (isValid == true) {
      $('#interview_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updateInterview') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#interview_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitInterview').prop('disabled', true);
          $('#submitInterview').text('Process....');
        },
        success: function(res) {
          $('#submitInterview').prop('disabled', false);
          $('#submitInterview').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Interview and References Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=interview_references";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitInterview').prop('disabled', false);
          $('#submitInterview').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitExperience").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }

  function updatePreferences() {
    var isValid = true;
    if ($('[name="preferred_work_schedule"]').val() == '') {
      document.getElementById("reqpreferecschedule").innerHTML = "* Please select prefered work schedule";
      isValid = false;
    }

    if ($('[name="country"]').val() == '') {
      document.getElementById("reqprecountry").innerHTML = "* Please select the country";
      isValid = false;
    }

    if ($('[name="state"]').val() == '') {
      document.getElementById("reqprestateI").innerHTML = "* Please select the state";
      isValid = false;
    }

    if ($('[name="specific_facilities"]').val() == '') {
      document.getElementById("reqspecificfacilities").innerHTML = "* Please enter the specific facilities";
      isValid = false;
    }

    if ($('[name="work_environment"]').val() == '') {
      document.getElementById("reqworkenvironement").innerHTML = "* Please select the work environment";
      isValid = false;
    }

    if ($('[name="shift_preferences"]').val() == '') {
      document.getElementById("reqshiftpreferences").innerHTML = "* Please select the shift preferences";
      isValid = false;
    }


    if (isValid == true) {
      $('#preferences_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updatePreferences') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#preferences_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitPersonalPreferences').prop('disabled', true);
          $('#submitPersonalPreferences').text('Process....');
        },
        success: function(res) {
          $('#submitPersonalPreferences').prop('disabled', false);
          $('#submitPersonalPreferences').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Personal Preferences Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=personal_preferences";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitPersonalPreferences').prop('disabled', false);
          $('#submitPersonalPreferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitPersonalPreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }

  function updateWorkPreference() {
    var isValid = true;
    if ($('[name="des_job_role[]"]').val() == '') {
      document.getElementById("reqjobroles").innerHTML = "* Please select desired job role";
      isValid = false;
    }

    if ($('[name="salary_expectation"]').val() == '') {
      document.getElementById("reqsalaryexp").innerHTML = "* Please enter salary expectation";
      isValid = false;
    }

    if ($('[name="benefit_prefer[]"]').val() == '') {
      document.getElementById("reqbenefitsprefer").innerHTML = "* Please select benefits preferences ";
      isValid = false;
    }


    if (isValid == true) {
      $('#workpreference_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updateWorkPreference') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#workpreference_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitWorkPreferences').prop('disabled', true);
          $('#submitWorkPreferences').text('Process....');
        },
        success: function(res) {
          $('#submitWorkPreferences').prop('disabled', false);
          $('#submitWorkPreferences').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Find Work Preferences Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=work_preferences";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitPersonalPreferences').prop('disabled', false);
          $('#submitPersonalPreferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitPersonalPreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }

  function additional_info_form() {

    var isValid = true;
    if ($('[name="additional_info_language"]').val() == '') {
      document.getElementById("reqinfolanguage").innerHTML = "* Please select language";
      isValid = false;
    }

    if ($('[name="volunteer_experience"]').val() == '') {
      document.getElementById("reqvolexp").innerHTML = "* Please enter Volunteer Experience";
      isValid = false;
    }

    if ($('[name="hobbies_interests"]').val() == '') {
      document.getElementById("reqhobbiesint").innerHTML = "* Please enter Hobbies and Interests";
      isValid = false;
    }


    if (isValid == true) {
      $('#additional_info_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updateAdditionalInfo') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#additional_info_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitAdditionalInformation').prop('disabled', true);
          $('#submitAdditionalInformation').text('Process....');
        },
        success: function(res) {
          $('#submitAdditionalInformation').prop('disabled', false);
          $('#submitAdditionalInformation').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Additional Information Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=additional_info";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitPersonalPreferences').prop('disabled', false);
          $('#submitPersonalPreferences').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitPersonalPreferences").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }

  function professional_membership_form() {

    var isValid = true;

    if ($('[name="des_profession_association[]"]').val() == '') {

      document.getElementById("reqprofessassociation").innerHTML = "* Please select professional association";
      isValid = false;

    }


    if ($('[name="prof_membership_numbers"]').val() == '') {

      document.getElementById("reqmembernumbers").innerHTML = "* Please enter memebership numbers";
      isValid = false;
    }

    if ($('[name="prof_membership_status"]').val() == '') {

      document.getElementById("reqmemberstatus").innerHTML = "* Please select membership status";
      isValid = false;
    }


    if (isValid == true) {
      $('#professional_memb_form').find('.text-danger').hide();
      $.ajax({
        url: "{{ route('nurse.updateProfessionalMembership') }}",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData($('#professional_memb_form')[0]),
        dataType: 'json',
        beforeSend: function() {
          $('#submitProfessionalMembership').prop('disabled', true);
          $('#submitProfessionalMembership').text('Process....');
        },
        success: function(res) {
          $('#submitProfessionalMembership').prop('disabled', false);
          $('#submitProfessionalMembership').text('Update Profile');

          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Professional Membership Updated Successfully',
            }).then(function() {
              window.location.href = "{{ route('nurse.my-profile') }}?page=professional_membership";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }

        },
        error: function(errorss) {
          $('#submitProfessionalMembership').prop('disabled', false);
          $('#submitProfessionalMembership').text('Save Changes');
          console.log("errorss", errorss);
          for (var err in errorss.responseJSON.errors) {
            $("#submitProfessionalMembership").find("[name='" + err + "']").after("<div class='text-danger'>" + errorss.responseJSON.errors[err] + "</div>");
          }
        }
      });
    }
    return false;
  }

  function stillWorking(i) {

    if ($(".still_working-" + i).prop('checked') == true) {
      $(".working-" + i).hide();
      $(".still_working1-" + i).val("1");
    } else {
      $(".working-" + i).show();
      $(".end_date-" + i).val("");
      $(".still_working1-" + i).val("0");
    }
  }

  function currently_position(i) {
    if ($(".currently_position-" + i).prop('checked') == true) {
      $(".empl_end_date-" + i).hide();
    } else {
      $(".empl_end_date-" + i).show();
      $(".employeement_end_date-" + i).val("");
    }
  }

  function currently_position_1(i) {
    if ($(".currently_position-" + i).prop('checked') == true) {
      $(".empl_end_date-" + i).addClass('d-none');
    } else {
      $(".empl_end_date-" + i).removeClass('d-none');
      $(".employeement_end_date-" + i).val("");
    }
  }

  function delete_reference(i, user_id, referee_id) {
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteReferee') }}",
      data: {
        user_id: user_id,
        referee_id: referee_id,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".referee_data-" + i).remove();
        }

      }
    });
  }

  function delete_reference1(i) {
    $(".referee_data-" + i).remove();
  }

  function delete_certification(i, user_id, certificate_id) {
    $.ajax({
      type: "post",
      url: "{{route('nurse.deleteCertification')}}",
      data: {
        user_id: user_id,
        certificate_id: certificate_id,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".license_number_div_" + i).remove();
        }
      }
    });
  }

  function deleteImg(i, user_id, img) {
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteImg') }}",
      data: {
        user_id: user_id,
        img: img,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".trans_img-" + i).remove();
        }
      }
    });
  }

  function deleteImg1(i, user_id, img, country_name, img_text) {
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteImg1') }}",
      data: {
        user_id: user_id,
        img: img,
        country_name: country_name,
        img_text: img_text,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".trans_img" + img_text + country_name + i).remove();
        }

      }
    });
  }

  function deleteanoImg1(i, user_id, img, country_name, img_text) {
    // alert(".trans_img"+img_text+country_name+i);
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteImg1') }}",
      data: {
        user_id: user_id,
        img: img,
        country_name: country_name,
        img_text: img_text,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".edu_img" + img_text + country_name).remove();
        }
      }
    });
  }

  function deleteanoImg1(i, user_id, img, country_name, img_text) {
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteAnoImg1') }}",
      data: {
        user_id: user_id,
        img: img,
        country_name: country_name,
        img_text: img_text,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".edu_img" + img_text + 'tran_' + i).remove();
          $(".edu_img" + img_text + 'certifi_' + i).remove();
          $(".edu_img" + img_text + 'edu_' + i).remove();
        }
      }
    });
  }

  function deleteanoImgcert(i, m, user_id, img) {
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteanoImgcert') }}",
      data: {
        user_id: user_id,
        certificate_id: m,
        img: img,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          var old_files = JSON.parse($(".certificate_upload_certification-" + m).val());
          console.log("old_files", old_files);
          const itemToRemove = img;

          const result = old_files.filter(item => item !== itemToRemove);

          console.log(result); // [1, 2, 4, 5]
          $(".certificate_upload_certification-" + m).val(JSON.stringify(result));
          $(".ano_certifi_imgscertifi_" + m + " .edu_imgano_certifi_imgscertifi_" + i).remove();

        }
      }
    });
  }


  function deleteImgCert(i, user_id, img) {
    $.ajax({
      type: "post",
      url: "{{ route('nurse.deleteImgCert') }}",
      data: {
        user_id: user_id,
        img: img,
        _token: '{{ csrf_token() }}'
      },
      cache: false,
      success: function(data) {
        if (data == 1) {
          $(".acls_img-" + i).remove();
        }

      }
    });
  }

  var input = document.getElementsByClassName('degree_transcript')[0];

  input.onclick = function() {
    this.value = null;
  };

  function changeImg(user_id) {
    var files = $('.degree_transcript')[0].files;
    console.log("files", files.length);
    var form_data = "";
    form_data = new FormData();

    for (var i = 0; i < files.length; i++) {
      form_data.append("upload_images[]", files[i], files[i]['name']);
    }

    form_data.append("user_id", user_id);
    form_data.append("_token", '{{ csrf_token() }}');

    $.ajax({
      type: "post",
      url: "{{ route('nurse.uploadImgs') }}",
      cache: false,
      contentType: false,
      processData: false,
      async: true,
      data: form_data,

      success: function(data) {
        var image_array = JSON.parse(data);
        var htmlData = '';
        for (var i = 0; i < image_array.length; i++) {
          console.log("degree_transcript", image_array[i]);
          var img_name = image_array[i];
          console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
          htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
        }
        $(".degree_transcript_imgs").html(htmlData);
      }
    });

  }

  function changeImg1(user_id, i, field_name, country_name) {
    var files = $('.' + field_name + '_' + country_name)[0].files;
    console.log("files", '.' + field_name + '_' + country_name);
    var form_data = "";
    form_data = new FormData();
    for (var i = 0; i < files.length; i++) {
      form_data.append("upload_images[]", files[i], files[i]['name']);
    }

    form_data.append("user_id", user_id);
    form_data.append("country_name", country_name);
    form_data.append("field_name", field_name);
    form_data.append("_token", '{{ csrf_token() }}');

    $.ajax({
      type: "post",
      url: "{{ route('nurse.uploadImgs1') }}",
      cache: false,
      contentType: false,
      processData: false,
      async: true,
      data: form_data,

      success: function(data) {

        var image_array = JSON.parse(data);
        var htmlData = '';
        console.log("data", image_array);
        for (var i = 0; i < image_array.length; i++) {
          console.log("degree_transcript", image_array[i]);
          var img_name = image_array[i];
          var img_text = field_name;
          console.log("img_name", 'deleteImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
          htmlData += '<div class="trans_img trans_img-' + (i + 1) + ' trans_img' + field_name + country_name + i + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteImg1(' + i + ',' + user_id + ',\'' + image_array[i] + '\',\'' + country_name + '\',\'' + img_text + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
        }
        $("." + field_name + country_name).html(htmlData);


      }
    });

  }

  function deleteDatabaseImgs(user_id, field_name) {
    $.ajax({
      type: "POST",
      url: "{{ url('nurse/deletecertification_img') }}",
      data: {
        user_id: user_id,
        field_name: field_name,
        _token: "{{ csrf_token() }}"
      },
      cache: false,
      success: function(data) {

      }
    });
  }

  function deleteDatabaseanoImgs(user_id, field_name, i) {
    // $.ajax(
    //   type: "POST",
    //   url: "{{ url('nurse/deletecertification_img') }}",
    //   data: {
    //     user_id: user_id,
    //     field_name: field_name,
    //     _token: "{{ csrf_token() }}"
    //   },
    //   cache: false,
    //   success: function(data) {

    //   }
    // });
  }

  $('.js-example-basic-multiple_emst').keyup(function() {
    alert("hello");
    var searchBoxHtml = `
                    <div class="extra-search-container">
                        <input type="text" class="extra-search-box" placeholder="Search...">
                        <button class="clear-button" type="button">&times;</button>
                    </div>`;

    if ($('.select2-results').find('.extra-search-container').length === 0) {
      $('.select2-results').prepend(searchBoxHtml);
    }

    var $searchBox = $('.extra-search-box');
    var $clearButton = $('.clear-button');

    $searchBox.on('input', function() {

      var searchTerm = $(this).val().toLowerCase();
      $('.select2-results__option').each(function() {
        var text = $(this).text().toLowerCase();
        if (text.includes(searchTerm)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });

      $clearButton.toggle($searchBox.val().length > 0);
    });

    $clearButton.on('click', function() {
      $searchBox.val('');
      $searchBox.trigger('input');
    });
  });
</script>
<script>
  const statusMap = {
    1: {
      label: 'Not Started',
      class: 'status-not-started'
    },
    2: {
      label: 'Pending',
      class: 'status-pending'
    },
    3: {
      label: 'Submitted',
      class: 'status-submitted'
    },
    4: {
      label: 'In Review',
      class: 'status-in-review'
    },
    5: {
      label: 'Verified',
      class: 'status-verified'
    },
    6: {
      label: 'Incomplete',
      class: 'status-incomplete'
    },
    7: {
      label: 'Expired',
      class: 'status-expired'
    },
  };

  const select = document.getElementById('countrySwitcher');
  const pill = document.getElementById('statusPill');

  select?.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const countryCode = this.value;
    const status = selectedOption.dataset.status || 1;

    pill.className = 'status-pill ' + statusMap[status].class;
    pill.innerText = statusMap[status].label;

    fetch("{{ route('nurse.active-country') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
          country_code: countryCode,
        })
      })
      .then(res => res.json())
      .then(data => {
        window.location.reload();
      })
      .catch(err => console.error(err));
  });

  document.getElementById('countrySwitcher')?.addEventListener('change', function() {

    if (this.value === 'manage') {
      window.location.href = '#registrations-section';
      return;
    }

    const status = this.options[this.selectedIndex].dataset.status || 1;

    const pill = document.getElementById('statusPill');
    pill.className = 'status-pill ' + statusMap[status].class;
    pill.innerText = statusMap[status].label;
  });
</script>
<!-- =================================

    Change password  Script

    ================================== -->
<script>
  function ChangePassword() {
    $('#ChangePassword').find('.text-danger').hide();
    $.ajax({
      url: "{{ route('nurse.changepassword') }}",
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#ChangePassword')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#signup_btn').prop('disabled', true);
        $('#signup_btn').text('Process...');
      },
      success: function(data) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Update');
        if (data.status == 2) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Password Changed Successfully',
          }).then(function() {
            window.location.href = "{{ route('nurse.my-profile') }}";
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message,
          });
        }
      },
      error: function(eror) {
        $('#signup_btn').prop('disabled', false);
        $('#signup_btn').text('Update Password');
        console.log(eror);
        for (var err in eror.responseJSON.errors) {
          console.log(eror.responseJSON.errors[err]);
          if (eror.responseJSON.errors[err] == "The password field is required.") {
            $("#ChangePassword").find("[name='" + err + "']").after("<div class='text-danger'>The new password is required.</div>");
          } else {
            if (eror.responseJSON.errors[err] == "The password confirmation field is required.") {
              $("#ChangePassword").find("[name='" + err + "']").after("<div class='text-danger'>The confirm new password is required.</div>");
            } else {
              $("#ChangePassword").find("[name='" + err + "']").after("<div class='text-danger'>" + eror.responseJSON.errors[err] + "</div>");
            }

          }

        }
      }
    });
    return false;
  }
</script>

<script>
  function coming_soon() {

    $('#commingsoonModel').modal('show');
  }

  function get_new_plice_check() {

    $('#get_new_plice_checkModel').modal('show');
  }
</script>
<script>
  // Get today's date in YYYY-MM-DD format
  const today = new Date().toISOString().split('T')[0];

  // Set the minimum date of the input to today
  const dateInput = document.getElementById('available_date');
  dateInput.setAttribute('min', today);
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>