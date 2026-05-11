@extends('nurse.layouts.layout')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ url('/public') }}/nurse/assets/css/jquery.ui.datepicker.monthyearpicker.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <style type="text/css">
        .hide_profile_image {
            display: none !important;
        }

        span.select2.select2-container {
            padding: 5px !important;
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white !important;
            border: 1px solid #0000 !important;
            border-radius: 4px !important;
            cursor: text !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000 !important;
            border: 1px solid #000 !important;
            border-radius: 4px !important;
            cursor: default !important;
            color: #fff !important;
            float: left;
            padding: 0;
            padding-right: 0.75rem;
            margin-top: calc(0.375rem - 2px);
            margin-right: 0.375rem;
            padding-bottom: 2px;
            white-space: normal;
            line-height: 20px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
            font-size: 20px !important;
            float: left;
            padding-right: 3px;
            padding-left: 3px;
            margin-right: 1px;
            margin-left: 3px;
            font-weight: 700;
            line-height: 20px;
        }

        .registration_progress {
            font-weight: 900;
            background-color: black;
            color: #fff;
        }

        form#language_skills_form ul.select2-selection__rendered {
            box-shadow: none;
            max-height: inherit;
            border: none;
            position: relative;
        }

        .sublang_main_div select {
            padding: 5px;
            border: 1px solid #dddddd;
            height: 50px;
        }

        .custom-select-wrapper {
            position: relative;
            width: 100%;
        }

        .custom-select {
            width: 100%;
            padding: 10px;
            appearance: none;
            /* Remove native arrow */
            -webkit-appearance: none;
            -moz-appearance: none;
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Custom arrow */
        .custom-select-wrapper::after {
            content: "▼";
            position: absolute;
            top: 59%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
            color: black;
            height: 36px !important;
            width: 20px;
        }

        form#update_profile_form ul.select2-selection__rendered {
            box-shadow: none;
            max-height: inherit;
            border: none;
            position: relative;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <section class="section-box mt-0">
            <div class="">
                <div class="row m-0 profile-wrapper">
                    <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

                        @include('healthcare.settings.sidebar')
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
                        <div class="content-single content_profile">


                            <div class="tab-content">
                                <?php $user_id = '';
                                $i = 0; ?>

                                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">


                                    <div class="card shadow-sm border-0 p-4 mt-30">

                                        <h3 class="mt-0 color-brand-1 mb-2">Users</h3>
                                        <div class="invite_user_btn">
                                            <a href="#" class="btn btn-default invite_user_btn" style="float: right;"
                                                data-toggle="modal" data-target="#inviteUserModal">Invite User</a>
                                        </div>
                                        <table class="table table-hover align-middle mb-0">

                                        <thead class="table-light">
                                            <tr>
                                                <th>Sno</th>
                                                
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Invitation Status</th>
                                                <th>User Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($recruiter_data as $recruit_data)
                                            <!-- User Row -->
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                
                                                <td>{{ $recruit_data->email }}</td>

                                                <td>
                                                    <span class="badge bg-primary">
                                                    @if($recruit_data->role == 2)
                                                        Admin
                                                    @endif  
                                                    @if($recruit_data->role == 5)
                                                        Recruiter
                                                    @endif  
                                                    </span>
                                                </td>

                                                

                                                <td>
                                                    
                                                    @if($recruit_data->email_verify == 0 && $recruit_data->emailVerified == 0 && $recruit_data->user_stage == 0)
                                                    <span class="badge bg-danger">  
                                                    Pending
                                                    </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                        Accepted 
                                                        </span>
                                                    @endif  
                                                        
                                                    
                                                </td>
                                                <td>
                                                        @if($recruit_data->role == 5)
                                                        <div class="form-check form-switch">
                                                        <input class="form-check-input statusToggle"
                                                                type="checkbox"
                                                                data-id="{{ $recruit_data->id }}" onclick="deactivateUser({{ $recruit_data->id }})" style="margin-top:12px;"
                                                                {{ $recruit_data->status == 1 ? 'checked' : '' }}>
                                                        </div>
                                                        @endif
                                                </td>
                                                <td class="text-end">

                                                    
                                                    @if($recruit_data->role == 5)
                                                    
                                                    <button class="btn btn-sm btn-outline-secondary" onclick="deleteUser({{ $recruit_data->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>

                                        </table>  


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="inviteUserModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Invite User</h5>
                            <button type="button" class="close btn" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">

                            <form id="invite_user_form" method="POST" onsubmit="return invite_user_form()">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter user email"
                                        required>
                                </div>

                                <!-- <div class="mb-3">
                        <label class="form-label">Assign Role</label>
                        <select class="form-select" name="role">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="recruiter">Recruiter</option>
                        </select>
                    </div> -->


                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel_invitation_modal close" 
                                data-dismiss="modal"> 
                                Cancel
                            </button>

                            <button type="submit" id="invite_user_btn" class="btn btn-primary">
                                Send Invitation
                            </button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteConfirmModal" tabindex="-1" style="opacity:1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmLabel">Confirm deletion</h5>
                <button type="button" class="btn-close close_delete_modal" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <p id="deleteConfirmText" class="mb-0">
                  Are you sure you want to delete this recruiter?
                </p>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_delete_modal" data-bs-dismiss="modal">
                  Cancel
                </button>
                <button type="button" class="btn btn-danger delete-draft-btn" id="confirmDeleteBtn">
                  Delete
                </button>
              </div>

            </div>
          </div>
        </div>
        </section>
    </main>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="{{ url('/public') }}/nurse/assets/js/jquery.ui.datepicker.monthyearpicker.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <script>
        $('.addAll_removeAll_btn').on('select2:open', function() {
            var $dropdown = $(this);
            var searchBoxHtml = `
            
            <div class="extra-buttons">
                <button class="select-all-button" type="button">Select All</button>
                <button class="remove-all-button" type="button">Remove All</button>
            </div>`;

            // Remove any existing extra buttons before adding new ones
            $('.select2-results .extra-search-container').remove();
            $('.select2-results .extra-buttons').remove();

            // Append the new extra buttons and search box
            $('.select2-results').prepend(searchBoxHtml);

            // Handle Select All button for the current dropdown
            $('.select-all-button').on('click', function() {
                var $currentDropdown = $dropdown;
                var allValues = $currentDropdown.find('option').map(function() {
                    return $(this).val();
                }).get();
                $currentDropdown.val(allValues).trigger('change');
            });

            // Handle Remove All button for the current dropdown
            $('.remove-all-button').on('click', function() {
                var $currentDropdown = $dropdown;
                $currentDropdown.val(null).trigger('change');
            });
        });
        $('.js-example-basic-multiple').on('select2:open', function() {
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

        $('.js-example-basic-multiple').select2();

        // Dynamically add the clear button
        const clearButton = $('<span class="clear-btn">✖</span>');
        $('.select2-container').append(clearButton);

        // Handle the visibility of the clear button
        function toggleClearButton() {

            const selectedOptions = $('.js-example-basic-multiple').val();
            if (selectedOptions && selectedOptions.length > 0) {
                clearButton.show();
            } else {
                clearButton.hide();
            }
        }

        // Attach change event to select2
        $('.js-example-basic-multiple').on('change', toggleClearButton);

        // Clear button click event
        clearButton.click(function() {

            $('.js-example-basic-multiple').val(null).trigger('change');
            toggleClearButton();
        });

        // Initial check
        toggleClearButton();
        $('.js-example-basic-multiple').each(function() {
            let listId = $(this).data('list-id');

            let items = [];
            console.log("listId", listId);
            $('#' + listId + ' li').each(function() {
                console.log("value", $(this).data('value'));
                items.push({
                    id: $(this).data('value'),
                    text: $(this).text()
                });
            });
            console.log("items", items);
            $(this).select2({
                data: items
            });
        });


        $(".invite_user_btn").click(function() {
            $("#inviteUserModal").modal("show");
        });

        function invite_user_form() {
            var isValid = true;




            if (isValid == true) {
                $.ajax({
                    url: "{{ route('medical-facilities.inviteUser') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData($('#invite_user_form')[0]),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#invite_user_btn').prop('disabled', true);
                        $('#invite_user_btn').text('Process....');
                    },
                    success: function(res) {
                        if (res.status == '1') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User Invited Successfully',
                            }).then(function() {
                                window.location.href = '';

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
                        $('#invite_user_btn').prop('disabled', false);
                        $('#invite_user_btn').text('Save Changes');
                        console.log("errorss", errorss);

                    }

                });
            }

            return false;
        }

        function deactivateUser(user_id){
      //alert(user_id);
      var status = $('.statusToggle').is(':checked') ? 1 : 0;
      //alert(status);
      $.ajax({
          url: "{{route('medical-facilities.deactivateUser')}}",
          type: "get",
          
          
          data: {
              user_id: user_id,
              status:status
          },
          dataType: 'json',
          
          success: function(data) {
            
            if (data.status == 1) {

              if(data.user_status == 1){
                var msg = "User Activated Successfully";
              }

              if(data.user_status == 0){
                var msg = "User Deactivated Successfully";
              }
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: msg,
              }).then(function() {
              window.location.href = '';
              
            });
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

    function deleteUser(user_id){
      
          $("#deleteConfirmModal").show();
          $("#confirmDeleteBtn").attr("data-id",user_id);
        //return false;
    }

    $("#confirmDeleteBtn").click(function(){
      var user_id = $(this).data("id");
      //alert(user_id);

      $.ajax({
        url: "{{route('medical-facilities.deleteUser')}}",
        type: "get",
        
        
        data: {
            user_id: user_id
        },
        dataType: 'json',
        
        success: function(data) {
          
          if (data.status == 1) {

            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: "Recruiter deleted successfully",
            }).then(function() {
            window.location.href = '';
            
          });
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
    });

    $(".close_delete_modal").click(function(){
      $("#deleteConfirmModal").hide();
    });
    </script>
    <script>
        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".error").remove();
            $.each(msg, function(key, value) {
                $('#district_id').after('<span class="error">' + value + '</span>');
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>

    <script>
        jQuery(document).ready(function() {

            var el;
            var options;
            var canvas;
            var span;
            var ctx;
            var radius;

            var createCanvasVariable = function(id) { // get canvas
                el = document.getElementById(id);
            };

            var createAllVariables = function() {
                options = {
                    percent: el.getAttribute('data-percent') || 25,
                    size: el.getAttribute('data-size') || 165,
                    lineWidth: el.getAttribute('data-line') || 10,
                    rotate: el.getAttribute('data-rotate') || 0,
                    color: el.getAttribute('data-color')
                };

                canvas = document.createElement('canvas');
                span = document.createElement('span');
                span.textContent = options.percent + '%';

                if (typeof(G_vmlCanvasManager) !== 'undefined') {
                    G_vmlCanvasManager.initElement(canvas);
                }

                ctx = canvas.getContext('2d');
                canvas.width = canvas.height = options.size;

                el.appendChild(span);
                el.appendChild(canvas);

                ctx.translate(options.size / 2, options.size / 2); // change center
                ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

                radius = (options.size - options.lineWidth) / 2;
            };
            var drawCircle = function(color, lineWidth, percent) {
                percent = Math.min(Math.max(0, percent || 1), 1);
                ctx.beginPath();
                ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
                ctx.strokeStyle = color;
                ctx.lineCap = 'square'; // butt, round or square
                ctx.lineWidth = lineWidth;
                ctx.stroke();
            };
            var drawNewGraph = function(id) {
                el = document.getElementById(id);
                createAllVariables();
                drawCircle('#efefef', options.lineWidth, 100 / 100);
                drawCircle(options.color, options.lineWidth, options.percent / 100);
            };
            drawNewGraph('graph1');
        });
    </script>
@endsection
