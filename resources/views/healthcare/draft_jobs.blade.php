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

  .sublang_main_div select{
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
  appearance: none; /* Remove native arrow */
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
  top: 76%;
  right: 10px;
  transform: translateY(-50%);
  pointer-events: none;
  color: black;
  height: 36px !important;
  width: 20px;
}

form#shift_scheduling_form ul.select2-selection__rendered {
    box-shadow: none;
    max-height: inherit;
    border: none;
    position: relative;
  }

  .clear-btn{
    visibility: hidden;
  }

  .button-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:20px;
}

.btn-draft,
.btn-publish{
    cursor:pointer;
    padding:10px 18px;
    border-radius:8px;
    font-weight:500;
}

/* optional styling */
.btn-draft{
    background:#f3f4f6;
}

.button-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:20px;
}


/* optional styling */
.btn-draft{
    background:#f3f4f6;
}

.btn-publish{
    background:black;
    color:white;
}

.btn-publish:hover{
    background:black;
    color:white;
}

.preview-wrapper{
    max-width:900px;
}

.job-preview-card{
    background:#fff;
    border-radius:14px;
    padding:22px;
    box-shadow:0 2px 10px rgba(0,0,0,.06);
    border:1px solid #eee;
    margin-bottom:20px;
}

/* top section */
.job-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.job-left{
    display:flex;
    gap:14px;
    align-items:center;
}

.job-logo{
    width:50px;
    height:50px;
    border-radius:10px;
    object-fit:cover;
}

.job-title{
    margin:0;
    font-size:18px;
    font-weight:600;
}

.job-company{
    margin:0;
    font-size:14px;
    color:#777;
}

.job-right{
    text-align:right;
}

.status-badge{
    display:inline-block;
    padding:4px 10px;
    border-radius:20px;
    font-size:12px;
    margin-right:6px;
}

.draft{background:#f1f5f9;}
.live{background:#dcfce7;color:#166534;}

.match{
    background:#ecfdf5;
    padding:5px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

/* meta */
.job-meta{
    margin-top:15px;
    display:flex;
    flex-wrap:wrap;
    gap:15px;
    font-size:14px;
}

/* tags */
.job-tags{
    margin-top:14px;
}

.tag{
    padding:5px 12px;
    border-radius:20px;
    font-size:12px;
    margin-right:8px;
}

.urgent{background:#fee2e2;color:#dc2626;}
.instant{background:#e0f2fe;color:#0284c7;}
.new{background:#ecfccb;color:#65a30d;}

/* match indicators */
.job-match{
    margin-top:14px;
    font-size:13px;
}

.dot{
    height:10px;
    width:10px;
    border-radius:50%;
    display:inline-block;
    margin:0 6px;
}

.green{background:#22c55e;}
.yellow{background:#eab308;}
.red{background:#ef4444;}

/* footer */
.job-footer{
    margin-top:18px;
    display:flex;
    justify-content:flex-end;
    gap:12px;
}

.btn-dark{
    background:#000;
    color:#fff;
    border:none;
    padding:10px 18px;
    border-radius:8px;
}

.btn-outline{
    background:#fff;
    border:1px solid #ddd;
    padding:10px 18px;
    border-radius:8px;
}
.job-attributes{
    margin-top:18px;
    display:grid;
    grid-template-columns: repeat(4,1fr);
    gap:14px;
}

.attr{
    background:#f9fafb;
    border-radius:10px;
    padding:10px 12px;
}

.label{
    display:block;
    font-size:11px;
    color:#6b7280;
    margin-bottom:2px;
}

.value{
    font-size:14px;
    font-weight:600;
    color:#111827;
}

.job-menu{
    position:relative;
}

.menu-btn{
    background:none;
    border:none;
    font-size:22px;
    cursor:pointer;
    padding:5px 10px;
}

.menu-dropdown{
    display:none;
    position:absolute;
    right:0;
    top:35px;
    background:#fff;
    border-radius:8px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
    min-width:160px;
    z-index:10;
}

.menu-dropdown a{
    display:block;
    padding:10px 15px;
    text-decoration:none;
    color:#333;
}

.menu-dropdown a:hover{
    background:#f3f3f3;
}

.job-menu.active .menu-dropdown{
    display:block;
}
@media(max-width:768px){
    .job-attributes{
        grid-template-columns: repeat(2,1fr);
    }
}

.job-title{
  font-size:16px;
}

.no-jobs-box h3{
  font-size:18px;
  text-align:center;
}
</style>
@endsection

@section('content')
<main class="main">
  <section class="section-box mt-0">
    <div class="">
      <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="deleteConfirmLabel">Confirm deletion</h5>
              <button type="button" class="btn-close close_delete_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <p id="deleteConfirmText" class="mb-0"></p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary close_delete_modal" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                Delete all
              </button>
            </div>

          </div>
        </div>
      </div>
      <div class="row m-0 profile-wrapper">
        <div class="col-lg-3 col-md-4 col-sm-12 p-0 left_menu">

        @include('healthcare.layouts.job_sidebar')
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 right_content">
          <div class="content-single content_profile">
            

            <div class="tab-content">
                <?php $user_id=''; $i = 0;?>

                <div class="tab-pane fade" id="tab-my-profile-setting" style="display: block;opacity:1;">

                    
                    <div class="card shadow-sm border-0 p-4 mt-30">
                      @include('healthcare.layouts.top_links')
                      <h3 class="mt-0 color-brand-1 mb-2 job-title">Draft Jobs</h3>
                      <div class="preview-wrapper">

                            <!-- Card -->
                            @if(count($job_post_data)>0) 
                            @foreach($job_post_data as $job_post) 
                            <div class="job-preview-card">

                                <div class="job-top">
                                    <div class="job-left">
                                        

                                        <div>
                                            <h3 class="job-title">{{ $job_post->job_title }}</h3>
                                            
                                        </div>
                                    </div>
                                    <div class="job-menu">
                                        <button class="menu-btn">⋮</button>
                                        <div class="menu-dropdown">
                                            <a href="{{ route('medical-facilities.job_details',['job_id'=>$job_post->id]) }}">View</a>
                                            <a href="{{ route('medical-facilities.location_work_modal') }}?job_id={{ $job_post->id }}">Edit</a>
                                            <a href="#">Duplicate</a>
                                            <a href="#" data-bs-toggle="modal"
                                              data-bs-target="#deleteModal"
                                              data-id="{{ $job_post->id }}">Delete</a>
                                            <a href="#" data-bs-toggle="modal"
                                              data-bs-target="#publishModal"
                                              data-id="{{ $job_post->id }}">Publish</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="job-attributes">

                                    <div class="attr">
                                        <span class="label">Type of Nurse</span>
                                        <span class="value">
                                        @php
                                            $nurse_type = json_decode($job_post->nurse_type);
                                        @endphp
                                        {{ $nurse_type[0] ?? '—' }}
                                        </span>
                                    </div>

                                    <div class="attr">
                                        <span class="label">Specialty</span>
                                        @php
                                            $speciality_type = (!empty($job_post->typeofspeciality))?$job_post->typeofspeciality:[];
                                            if (is_string($speciality_type)) {
                                                $speciality_type = json_decode($speciality_type, true);
                                            }
                                            $speciality_data = DB::table("speciality")->where("id",isset($speciality_type[0])?$speciality_type[0]:0)->first();
                                        @endphp
                                        <span class="value">{{ $speciality_data->name ?? '—' }}</span>
                                    </div>

                                    <div class="attr">
                                        <span class="label">Sector</span>
                                        <span class="value">{{ $job_post->sector ?? '—' }}</span>
                                    </div>

                                    <div class="attr">
                                        <span class="label">No of Position</span>
                                        <span class="value">{{ $job_post->position_open ?? '—' }}</span>
                                    </div>

                                </div>
                                

                            </div>
                            @endforeach
                            @else
                            
                            <div class="no-jobs-box">
                                

                                <h3>No Jobs Found</h3>


                                <!-- <a href="/create-job" class="create-job-btn">Create Job</a> -->
                            </div>
                            @endif

                        </div>  
    
                       
                      </div>
    
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this job?
                </div>

                <div class="modal-footer">
                    
                        

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="button" class="btn btn-danger deleteJobs">
                            Delete
                        </button>
                    
                </div>

            </div>
        </div>
      </div>

      <div class="modal fade" id="publishModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Publish Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to publish this job?
                </div>

                <div class="modal-footer">
                    
                        

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="button" class="btn btn-danger publishJobs">
                            Publish
                        </button>
                    
                </div>

            </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteModal = document.getElementById('deleteModal');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        
        var form = document.getElementById('deleteForm');
        $(".deleteJobs").attr("onclick","deleteJobs("+id+")");
        
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var publishModal = document.getElementById('publishModal');

    publishModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        
        
        $(".publishJobs").attr("onclick","publishJobs("+id+")");
        
    });
});
</script>
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
        console.log("listId",listId);
        $('#' + listId + ' li').each(function() {
            console.log("value",$(this).data('value'));
            items.push({ id: $(this).data('value'), text: $(this).text() });
        });
        console.log("items",items);
        $(this).select2({
            data: items
        });
    });
</script>
<script>
  document.querySelectorAll('.menu-btn').forEach(btn=>{
      btn.addEventListener('click', function(e){
          e.stopPropagation();

          document.querySelectorAll('.job-menu')
              .forEach(m => m.classList.remove('active'));

          this.parentElement.classList.toggle('active');
      });
  });

  document.addEventListener('click', ()=>{
      document.querySelectorAll('.job-menu')
          .forEach(m => m.classList.remove('active'));
  });
</script>
<script>

    $(document).on('change', 'input[name="listing_expiry"]', function () {
      $('input[name="listing_expiry"]').removeAttr("checked");
      var listing_expiry_value = $(this).val();
      if(listing_expiry_value == "5"){
        $(".custom_date_box").removeClass('d-none');
      }else{
        $(".custom_date_box").addClass('d-none');
      }
    });

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

    function saveDraft(save){

        $.ajax({
            url: "{{ route('medical-facilities.saveDraft') }}",
            type: "POST",
            dataType: "json",
            data: {
                save:save,
                _token:"{{ csrf_token() }}"
            },

            success: function(res){

                if(res.status == 1){
                    Swal.fire('Success','Job saved as Draft','success');
                }

                else if(res.status == 3){
                    Swal.fire('Success','Job Published Successfully','success')
                    .then(()=> window.location.href="{{ route('medical-facilities.reviewPublish') }}");
                }

                else if(res.status == 2){
                    Swal.fire('Info','Already saved in this state','info');
                }

                else{
                    Swal.fire('Error',res.message ?? 'Something went wrong','error');
                }

            }
        });  
    }

    $(".delete_modal").click(function(){
      var job_id = $(this).data("id");
      $("#deleteConfirmModal").show();
    })

    function deleteJobs(job_id){
      //alert(job_id);
      $.ajax({
        url: "{{ route('medical-facilities.deleteJobs') }}",
        type: "POST",
        dataType: "json",
        data: {
            job_id:job_id,
            _token:"{{ csrf_token() }}"
        },
        success: function(res){
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Job Deleted Successfully',
            }).then(function() {
              window.location.href = "{{ route('medical-facilities.draft_jobs') }}";
              
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }
        }
      });      
    }

    function publishJobs(job_id){
      //alert(job_id);
      $.ajax({
        url: "{{ route('medical-facilities.publishJobs') }}",
        type: "POST",
        dataType: "json",
        data: {
            job_id:job_id,
            _token:"{{ csrf_token() }}"
        },
        success: function(res){
          if (res.status == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Job Publish Successfully',
            }).then(function() {
              window.location.href = "{{ route('medical-facilities.draft_jobs') }}";
              
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.message,
            })
          }
        }
      });      
    }

  </script>
@endsection