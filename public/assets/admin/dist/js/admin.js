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


            beforeSend: function () {


                $('#sub_btn').prop('disabled', true);


                $('#php502').html('Uploading ...');


            },


            success: function (res) {


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