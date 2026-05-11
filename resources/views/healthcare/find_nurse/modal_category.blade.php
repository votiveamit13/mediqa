<style>
    .speciality-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .speciality-item input[type="checkbox"] {
        margin-right: 10px;
    }

    .loader {
        text-align: center;
        padding: 20px;
        font-size: 14px;
        color: #555;
    }

    .loader::after {
        content: "⏳ Loading...";
        display: block;
        font-weight: bold;
    }

    span.select2.select2-container {
        padding: 0 !important;
    }

    .swal2-container {
        z-index: 9999 !important;
    }
</style>
@if ($modal_no == 18)
    <div id="interviewPopup" class="interview-overlay">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="apply-box">
                <div class="apply-header">
                    <h5 class="modal-title">Invite to Interview</h5>
                    <span class="interview-close" data-close="applyPopup">&times;</span>
                </div>
                <div class="apply-body">
                    <input type="hidden" name="healthcare_id" value="{{ $healthcare_id }}">
                    <input type="hidden" name="nurse_id" value="{{ $nurse_detail->id }}">

                    <div class="d-flex gap-3 mt-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="profile-img mr-3">
                        <div>
                            <div class="name">{{ $nurse_detail->name }} {{ $nurse_detail->lastname }}</div>
                            <div class="sub-text">
                                <i class="fa fa-map-marker"></i> {{ state_name($nurse_detail->state) }},
                                {{ country_name($nurse_detail->country) }}
                            </div>
                            <div class="sub-text mt-1">
                                <i class="fa fa-briefcase"></i> 15 yrs Exp · ICU · ACLS, BLS
                            </div>
                        </div>
                    </div>

                    <div class="apply-alert">
                        <p><i class="fa fa-check-circle text-dark mr-1"></i>
                            <strong>You're inviting this nurse to an interview</strong>
                        </p>
                        <p class="check-content">They will be added directly to your interviews list</p>
                    </div>
                     <h5 class="interview-heading">Interview Details</h5>
                    <!-- Select Job Dropdown -->
                    <div class="select-job-label">
                        <label>Job</label>
                        <select class="apply-field job-select" name="job_id">
                            <option value="">Select Job</option>
                            @foreach ($jobs_list as $job_show)
                                <option value="{{ $job_show->id }}">{{ $job_show->job_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="select-job-label w-100">
                            <label>Interview Type</label>
                            <select class="apply-field-meeting meeting_mode" name="interview_type">
                                <option value="">Select Interview Type</option>
                                <option value="1">Onsite</option>
                                <option value="2">Zoom</option>
                                <option value="3">Teams</option>
                                <option value="4">Meet</option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                        <div class="select-job-label w-100">
                          <label>Preferred Date (Optional)</label>
                          <input type="date" class="form-control date-field"  min="{{ date('Y-m-d') }}" name="preferred_date" />
                        </div>
                    </div>

                    <div class="apply-msg select-job-label">
                        <label>Message</label>
                        <textarea name="message" placeholder="Add message"></textarea>
                    </div>

                    {{-- <div class="apply-alert">
                        <p><i class="fa fa-info-circle text-dark mr-1"></i>
                            <strong>What happens next?</strong>
                        </p>
                        <p class="check-content">The nurse will be notified and can respond to your interview invitation
                        </p>
                    </div> --}}
                </div>

                <div class="apply-footer">
                    <button class="btn-cancel interview-close" data-close="applyPopup">Cancel</button>
                    <button type="button" onclick="interviewInviteSend()" class="btn-save ">Send Invite</button>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($modal_no == 17)
    <div id="applyPopup" class="apply-overlay">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="apply-box">
                <div class="apply-header">
                    <h5 class="modal-title">Invite to Apply</h5>
                    <span class="apply-close" data-close="applyPopup">&times;</span>
                </div>
                <div class="apply-body">
                    <input type="hidden" name="healthcare_id" value="{{ $healthcare_id }}">
                    <input type="hidden" name="nurse_id" value="{{ $nurse_detail->id }}">
                    <div class="d-flex gap-3 mt-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="profile-img mr-3">
                        <div>
                            <div class="name">{{ $nurse_detail->name }} {{ $nurse_detail->lastname }}</div>
                            <div class="sub-text">
                                <i class="fa fa-map-marker"></i> {{ state_name($nurse_detail->state) }},
                                {{ country_name($nurse_detail->country) }}
                            </div>
                            <div class="sub-text mt-1">
                                <i class="fa fa-briefcase"></i> 15 yrs Exp · ICU · ACLS, BLS
                            </div>
                        </div>
                    </div>
                    <div class="apply-alert">
                        <p><i class="fa fa-check-circle text-dark mr-1" aria-hidden="true"></i><strong> You're
                                inviting this nurse to apply for a job</strong></p>
                        <p class="check-content">They will receive an invitaion to apply for the selected job
                        </p>
                    </div>
                    <div class="select-job-label">
                        <label>Job</label>
                        <select class="apply-field job-select">
                            <option value="">Select Job</option>
                            @foreach ($jobs_list as $job_show)
                                <option value="{{ $job_show->id }}">{{ $job_show->job_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="apply-msg select-job-label">
                        <label>Message (Optional)</label>
                        <textarea placeholder="Add message"></textarea>
                    </div>
                    <div class="apply-alert">
                        <p><i class="fa fa-info-circle text-dark mr-1" aria-hidden="true"></i><strong> What
                                happen next ?</strong></p>
                        <p class="check-content">The nurse will be noticed and can view job details and submit
                            their application</p>
                    </div>
                </div>
                <div class="apply-footer">
                    <button class="btn-cancel apply-close" data-close="applyPopup">Cancel</button>
                    <button type="button" onclick="applyInviteSend()" class="btn-save ">Send Invite</button>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($modal_no == 13)
    <div class="modal-overlay" id="languageModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Language Filter</h4>
                <span class="close-btn" id="closelanguage" data-close="languageModal">&times;</span>
            </div>
            <div class="modal-body">
                <label for="agency">Language Skills</label>
                <ul id="language_filter" style="display:none;">
                    @if (!empty($language_skill))
                        @foreach ($language_skill as $language)
                            <li data-value="{{ $language->language_id }}">{{ $language->language_name }}</li>
                        @endforeach
                    @endif
                </ul>
                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="language_filter"
                    name="language_ids[]" multiple></select>
                <label for="agency">Specialized Language Skills</label>
                <ul id="language_spec" style="display:none;">
                    @if (!empty($specialized_lang_skills))
                        @foreach ($specialized_lang_skills as $spec_language)
                            <li data-value="{{ $spec_language->language_id }}">{{ $spec_language->language_name }}
                            </li>
                        @endforeach
                    @endif
                </ul>
                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="language_spec"
                    name="language_ids[]" multiple></select>
                <!-- <label for="language">Specialized Language Skills</label>
        <input type="text" name="language_skill"> -->
            </div>
            <div class="modal-footer">
                <button type="button" onclick="applylanguage()" class="btn btn-default"> Apply </button>
            </div>
        </div>
    </div>
    <script>
        function applylanguage() {
            removePageParam();

            // Collect selected values from both dropdowns
            let selectedValues = [];

            $(".js-example-basic-multiple").each(function() {
                let vals = $(this).val(); // array of selected IDs
                if (vals) {
                    selectedValues = selectedValues.concat(vals);
                }
            });

            // Toggle pagination
            $(".normal-pagination").addClass("d-none");
            $(".ajax-pagination").removeClass("d-none");

            // Get existing filters from session
            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            // Save combined language IDs
            filters_data.language = selectedValues;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log("filters_data", filters_data);

            // Trigger nurse fetch
            fetchNurse(1);

            // Close modal
            $("#languageModal").hide();
            $("#modalOverlay").hide();
        }

        function closelanguageModal() {
            $("#modalOverlay").hide();
            $("#languageModal").hide();

            // Reset state
            currentLayer = 0;
            $("#languageBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }

        $("#closelanguage").on("click", function() {
            closelanguageModal();
        });
    </script>
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
                console.log("dropdown", $currentDropdown);
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
    </script>

@endif
@if ($modal_no == 7)
    <div id="modalOverlay" class="modal-overlay">
        <div id="shiftTypeModal" class="side-modal">
            <div class="side-modal-content">
                <div class="modal-header">
                    <h3>Shift Type</h3>
                    <span class="close-btn" id="closeshiftType" data-close="shiftTypeModal">&times;</span>
                </div>
                <div id="shiftTypeBody" class="modal-body">
                    <div id="layer-0" class="layer" style="display:block;">
                        @foreach ($shiftType_list as $list)
                            @if ($list->parent == 0)
                                <label class="sub-heading shiftType-item" data-id="{{ $list->work_shift_id }}">
                                    <!-- <input type="checkbox" name="shiftType[]" value="{{ $list->work_shift_id }}"> -->
                                    <input type="checkbox" class="shiftType-checkbox" name="shiftType[]"
                                        value="{{ $list->work_shift_id }}">
                                    <span class="shiftType-name"
                                        onclick="loadChildshiftType({{ $list->work_shift_id }}, '{{ $list->shift_name }}')">
                                        {{ $list->shift_name }}
                                    </span>
                                </label>
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="applyshiftType()" class="btn btn-default"> Apply </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var currentLayer = 0;

        function loadChildshiftType(parentId, parentName, level = 1) {
            // Hide current layer if exists
            let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
            if (currentLayerEl) {
                currentLayerEl.style.display = 'none';
            }

            let body = document.getElementById('shiftTypeBody');

            // Create new layer with loader
            currentLayer++;
            let layer = document.createElement('div');
            layer.id = `layer-${currentLayer}`;
            layer.classList.add('layer');
            layer.style.display = 'block';

            let backButton = `<button class="back-btn" onclick="goShftTypeBack()">← Back</button> <br>`;
            layer.innerHTML =
            `<div class="breadcrumb">${parentName}</div>${backButton} <div class="loader"></div>`; // loader placeholder

            body.appendChild(layer);

            // Fetch children
            fetch(`{{ url('/healthcare-facilities/shiftType-child') }}/${parentId}?level=${level}`)
                .then(response => response.json())
                .then(data => {
                    // Clear loader
                    layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}`;

                    data.forEach(item => {
                        let clickHandler = item.has_children ?
                            `onclick="loadChildshiftType(${item.work_shift_id}, '${item.shift_name}', ${level + 1})"` :
                            '';
                        layer.innerHTML += `
                        <label class="sub-heading shiftType-item" data-id="${item.work_shift_id}">
                            <input type="checkbox" name="shiftType[]" class="shiftType-checkbox" value="${item.work_shift_id}">
                            <span class="shiftType-name" ${clickHandler}>${item.shift_name}</span>
                        </label>
                        <br>
                    `;
                    });
                })
                .catch(() => {
                    layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
                });
        }

        function goShftTypeBack() {
            let body = document.getElementById('shiftTypeBody');
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }

        function applyshiftType() {
            let selectedValues = [];
            removePageParam();
            $(".shiftType-checkbox:checked").each(function() {
                selectedValues.push($(this).val());
            });

            $(".normal-pagination").addClass("d-none");
            $(".ajax-pagination").removeClass("d-none");

            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            filters_data.shiftType = selectedValues;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log(filters_data);

            //var filters_data1 = sessionStorage.getItem("filters_data");
            fetchNurse(1);
            $("#modalOverlay").hide();
            console.log(selectedValues); // array of selected values
        }

        function closeshiftTypeModal() {
            $("#modalOverlay").hide();
            $("#shiftTypeModal").hide();

            // Reset state
            currentLayer = 0;
            $("#shiftTypeBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }

        $("#closeshiftType").on("click", function() {
            closeshiftTypeModal();
        });
    </script>
@endif
@if ($modal_no == 1)
    <div id="modalOverlay" class="modal-overlay">
        <div id="nurseTypeModal" class="side-modal">
            <div class="side-modal-content">
                <div class="modal-header">
                    <h3>Type of Nurse</h3>
                    <span class="close-btn" id="closenurseType" data-close="nurseTypeModal">&times;</span>
                </div>
                <div id="nurseTypeBody" class="modal-body">
                    <div id="layer-0" class="layer" style="display:block;">
                        @foreach ($nurseType_list as $list)
                            @if ($list->parent == 0)
                                <label class="sub-heading nurseType-item" data-id="{{ $list->id }}">
                                    <!-- <input type="checkbox" name="nurseType[]" value="{{ $list->id }}"> -->
                                    <input type="checkbox" class="nurseType-checkbox" name="nurseType[]"
                                        value="{{ $list->id }}">
                                    <span class="nurseType-name"
                                        onclick="loadChildnurseType({{ $list->id }}, '{{ $list->name }}')">
                                        {{ $list->name }}
                                    </span>
                                </label>
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="applynurseType()" class="btn btn-default"> Apply </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var currentLayer = 0;

        function loadChildnurseType(parentId, parentName) {
            let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
            if (currentLayerEl) {
                currentLayerEl.style.display = 'none';
            }

            let body = document.getElementById('nurseTypeBody');

            // Create new layer with loader
            currentLayer++;
            let layer = document.createElement('div');
            layer.id = `layer-${currentLayer}`;
            layer.classList.add('layer');
            layer.style.display = 'block';

            let backButton = `<button class="back-btn" onclick="goBack()">← Back</button> <br>`;
            layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}
                        <div class="loader"></div>`; // loader placeholder

            body.appendChild(layer);

            // Fetch children
            fetch(`{{ url('/healthcare-facilities/nurseType-child') }}/${parentId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear loader
                    layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}`;

                    // Render children
                    data.forEach(item => {
                        let clickHandler = item.has_children ?
                            `onclick="loadChildnurseType(${item.id}, '${item.name}')"` :
                            '';
                        layer.innerHTML += `
                        <label class="sub-heading nurseType-item" data-id="${item.id}">
                            <input type="checkbox" name="nurseType[]" class="nurseType-checkbox" value="${item.id}">
                            <span class="nurseType-name" ${clickHandler}>${item.name}</span>
                        </label>
                        <br>
                    `;
                    });
                })
                .catch(() => {
                    layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
                });
        }

        function goBack() {
            let body = document.getElementById('nurseTypeBody');
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }

        function applynurseType() {
            let selectedValues = [];
            removePageParam();
            $(".nurseType-checkbox:checked").each(function() {
                selectedValues.push($(this).val());
            });

            $(".normal-pagination").addClass("d-none");
            $(".ajax-pagination").removeClass("d-none");

            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            filters_data.nurseType = selectedValues;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log(filters_data);

            //var filters_data1 = sessionStorage.getItem("filters_data");
            fetchNurse(1);
            $("#modalOverlay").hide();
            console.log(selectedValues); // array of selected values
        }

        function closenurseTypeModal() {
            $("#modalOverlay").hide();
            $("#nurseTypeModal").hide();

            // Reset state
            currentLayer = 0;
            $("#nurseTypeBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }

        $("#closenurseType").on("click", function() {
            closenurseTypeModal();
        });
    </script>
@endif
@if ($modal_no == 2)
    <div id="modalOverlay" class="modal-overlay">
        <div id="specialityModal" class="side-modal">
            <div class="side-modal-content">
                <div class="modal-header">
                    <h3>Type of Speciality</h3>
                    <span class="close-btn" id="closeSpeciality" data-close="specialityModal">&times;</span>
                </div>
                <div id="specialityBody" class="modal-body">
                    <div id="layer-0" class="layer" style="display:block;">
                        @foreach ($speciality_list as $list)
                            @if ($list->parent == 0)
                                <label class="sub-heading speciality-item" data-id="{{ $list->id }}">
                                    <!-- <input type="checkbox" name="speciality[]" value="{{ $list->id }}"> -->
                                    <input type="checkbox" class="speciality-checkbox" name="speciality[]"
                                        value="{{ $list->id }}">
                                    <span class="speciality-name"
                                        onclick="loadChildSpeciality({{ $list->id }}, '{{ $list->name }}')">
                                        {{ $list->name }}
                                    </span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="applySpeciality()" class="btn btn-default"> Apply </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var currentLayer = 0;

        function loadChildSpeciality(parentId, parentName) {
            let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
            if (currentLayerEl) {
                currentLayerEl.style.display = 'none';
            }

            let body = document.getElementById('specialityBody');

            // Create new layer with loader
            currentLayer++;
            let layer = document.createElement('div');
            layer.id = `layer-${currentLayer}`;
            layer.classList.add('layer');
            layer.style.display = 'block';

            let backButton = `<button class="back-btn" onclick="goBack()">← Back</button>`;
            layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}
                        <div class="loader"></div>`; // loader placeholder

            body.appendChild(layer);

            // Fetch children
            fetch(`{{ url('/healthcare-facilities/speciality-child') }}/${parentId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear loader
                    layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}`;

                    // Render children
                    data.forEach(item => {
                        let clickHandler = item.has_children ?
                            `onclick="loadChildSpeciality(${item.id}, '${item.name}')"` :
                            '';
                        layer.innerHTML += `
                        <label class="sub-heading speciality-item" data-id="${item.id}">
                            <input type="checkbox" name="speciality[]" class="speciality-checkbox" value="${item.id}">
                            <span class="speciality-name" ${clickHandler}>${item.name}</span>
                        </label>
                    `;
                    });
                })
                .catch(() => {
                    layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
                });
        }

        function goBack() {
            let body = document.getElementById('specialityBody');
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }

        function applySpeciality() {
            let selectedValues = [];
            removePageParam();
            $(".speciality-checkbox:checked").each(function() {
                selectedValues.push($(this).val());
            });

            $(".normal-pagination").addClass("d-none");
            $(".ajax-pagination").removeClass("d-none");

            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            filters_data.speciality = selectedValues;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log(filters_data);

            //var filters_data1 = sessionStorage.getItem("filters_data");
            fetchNurse(1);
            $("#modalOverlay").hide();
            console.log(selectedValues); // array of selected values
        }

        function closeSpecialityModal() {
            $("#modalOverlay").hide();
            $("#specialityModal").hide();

            // Reset state
            currentLayer = 0;
            $("#specialityBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }

        $("#closeSpeciality").on("click", function() {
            closeSpecialityModal();
        });
    </script>
@endif
@if ($modal_no == 3)
    <div id="modalOverlay" class="modal-overlay">
        <div id="work_environment_modal" class="side-modal">
            <div class="side-modal-content">
                <div class="modal-header">
                    <h3>Work Environment</h3>
                    <span class="close-btn" id="closeWorkEnvironment"
                        data-close="work_environment_modal">&times;</span>
                    <!-- <div id="childSpecialityContainer"></div> -->
                </div>
                <div id="workEnvironmentBody" class="modal-body">
                    <div id="layer-0" class="layer" style="display:block;">
                        @foreach ($work_environment_list as $list)
                            <label class="sub-heading speciality-item" data-id="{{ $list->prefer_id }}">
                                <input type="checkbox" name="work_environment[]" class="work_environment_checkbox"
                                    value="{{ $list->prefer_id }}">
                                <span class="work-environment-name"
                                    onclick="loadWorkEnvironment({{ $list->prefer_id }}, '{{ $list->env_name }}')">{{ $list->env_name }}</span>
                            </label>
                            <div id="child-work-environment-{{ $list->prefer_id }}" class="child-container"></div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="applyWorkEnvironment()" class="btn btn-default"> Apply </button>

            </div>
        </div>
    </div>
    <script>
        var currentLayer = 0;

        function loadWorkEnvironment(parentId, parentName, level = 1) {


            let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
            if (currentLayerEl) {
                currentLayerEl.style.display = 'none';
            }

            let body = document.getElementById('workEnvironmentBody');

            // Create new layer with loader
            currentLayer++;
            let layer = document.createElement('div');
            layer.id = `layer-${currentLayer}`;
            layer.classList.add('layer');
            layer.style.display = 'block';

            let backButton = `<button class="back-btn" onclick="goWorkEnvironmentBack()">← Back</button>`;
            layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}
                        <div class="loader"></div>`; // loader placeholder

            body.appendChild(layer);

            fetch(`{{ url('/healthcare-facilities/work-environment-child') }}/${parentId}?level=${level}`)
                .then(response => response.json())
                .then(data => {
                    // Clear loader
                    layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}`;

                    data.forEach(item => {
                        console.log("has_children", item);
                        let clickHandler = item.has_children ?
                            `onclick="loadWorkEnvironment(${item.prefer_id}, \`${item.env_name}\`, ${level + 1})"` :
                            '';
                        layer.innerHTML += `
                        <label class="sub-heading speciality-item" data-id="${item.prefer_id}">
                            <input type="checkbox" name="work_environment[]" class="work_environment_checkbox" value="${item.prefer_id}">
                            <span class="work-environment-name" ${clickHandler}>${item.env_name}</span>
                        </label>
                    `;
                    });

                }).catch(() => {
                    layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
                });;
        }

        function goWorkEnvironmentBack() {
            let body = document.getElementById('workEnvironmentBody');
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }

        function loadSubEmpType(parentId) {
            //alert("hello");
            fetch(`{{ url('/healthcare-facilities/work-environment-child') }}/${parentId}`)
                .then(response => response.json())
                .then(data => {
                    let modalContent = document.querySelector('#work_environment_modal .side-modal-content');

                    modalContent.innerHTML = `
                    <div class="modal-header">Work Environment</h3>
                        <span class="close-btn" data-close="work_environment_modal">&times;</span>
                    </div>
                `;

                    data.forEach(item => {
                        let clickHandler = item.has_children ?
                            `onclick="loadWorkEnvironment(${item.prefer_id})"` :
                            '';

                        let html = `
                        <label class="sub-heading speciality-item" data-id="${item.prefer_id}">
                            <input type="checkbox" name="work_environment[]" class="work_environment_checkbox" value="${item.prefer_id}">
                            <span class="speciality-name" ${clickHandler}>${item.env_name}</span>
                        </label>
                        <div id="child-work-environment-${item.prefer_id}" class="child-container"></div>
                    `;
                        modalContent.innerHTML += html;
                    });
                });
        }

        function applyWorkEnvironment() {
            let selectedValues = [];
            removePageParam();
            $(".work_environment_checkbox:checked").each(function() {
                selectedValues.push($(this).val());
            });

            $(".normal-pagination").addClass("d-none");
            $(".ajax-pagination").removeClass("d-none");



            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            filters_data.work_environment = selectedValues;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log(filters_data);

            //var filters_data1 = sessionStorage.getItem("filters_data");


            fetchNurse(1);


            closeWorkEnvironmentModal();

            console.log(selectedValues); // array of selected values
        }

        function closeWorkEnvironmentModal() {
            $("#modalOverlay").hide();
            $("#work_environment_modal").hide();

            // Reset state
            currentLayer = 0;
            $("#workEnvironmentBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }

        // Bind close button once
        $("#closeSpeciality").on("click", function() {
            closeSpecialityModal();
        });

        $("#closeWorkEnvironment").on("click", function() {
            closeWorkEnvironmentModal();
        });
    </script>
@endif
@if ($modal_no == 6)
    <div id="modalOverlay" class="modal-overlay">
        <div id="employeement_type_modal" class="side-modal">
            <div class="side-modal-content">
                <div class="modal-header">
                    <h3>Employment Type</h3>
                    <span class="close-btn" id="closeEmpType" data-close="employeement_type_modal">&times;</span>
                    <!-- <div id="childSpecialityContainer"></div> -->
                </div>
                <div id="employeementTypeBody" class="modal-body">
                    <div id="layer-0" class="layer" style="display:block;">
                        @foreach ($employeement_type_list as $list)
                            <label class="sub-heading speciality-item" data-id="{{ $list->emp_prefer_id }}">
                                <input type="checkbox" name="employment_type[]" class="employeement_type_checkbox"
                                    value="{{ $list->emp_prefer_id }}">
                                <span class="employeement-type-name"
                                    onclick="loadEmployeementType({{ $list->emp_prefer_id }}, '{{ $list->emp_type }}')">{{ $list->emp_type }}</span>
                            </label>
                            <div id="child-employeement-type-{{ $list->emp_prefer_id }}" class="child-container">
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="applyEmploymentType()" class="btn btn-default"> Apply </button>

            </div>
        </div>
    </div>
    <script>
        var currentLayer = 0;

        function loadEmployeementType(parentId, parentName, level = 1) {


            let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
            if (currentLayerEl) {
                currentLayerEl.style.display = 'none';
            }

            let body = document.getElementById('employeementTypeBody');

            // Create new layer with loader
            currentLayer++;
            let layer = document.createElement('div');
            layer.id = `layer-${currentLayer}`;
            layer.classList.add('layer');
            layer.style.display = 'block';

            let backButton = `<button class="back-btn" onclick="goEmploymentTypeBack()">← Back</button>`;
            layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}
                        <div class="loader"></div>`; // loader placeholder

            body.appendChild(layer);

            fetch(`{{ url('/healthcare-facilities/employment-type-child') }}/${parentId}?level=${level}`)
                .then(response => response.json())
                .then(data => {
                    // Clear loader
                    layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}`;

                    data.forEach(item => {
                        console.log("has_children", item);
                        let clickHandler = item.has_children ?
                            `onclick="loadEmployeementType(${item.emp_prefer_id}, \`${item.emp_type}\`, ${level + 1})"` :
                            '';
                        layer.innerHTML += `
                        <label class="sub-heading speciality-item" data-id="${item.emp_prefer_id}">
                            <input type="checkbox" name="employment_type[]" class="employeement_type_checkbox" value="${item.emp_prefer_id}">
                            <span class="employment-type-name" ${clickHandler}>${item.emp_type}</span>
                        </label>
                    `;
                    });

                }).catch(() => {
                    layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
                });;
        }

        function goEmploymentTypeBack() {
            let body = document.getElementById('employeementTypeBody');
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }


        function applyEmploymentType() {
            let selectedValuesEmp = [];
            removePageParam();
            $(".employeement_type_checkbox:checked").each(function() {
                selectedValuesEmp.push($(this).val());
            });

            $(".normal-pagination").addClass("d-none");
            $(".ajax-pagination").removeClass("d-none");



            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            filters_data.employment_type = selectedValuesEmp;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log(filters_data);

            //var filters_data1 = sessionStorage.getItem("filters_data");


            fetchNurse(1);


            closeEmployeementTypeModal();

            console.log(selectedValuesEmp); // array of selected values
        }

        function closeEmployeementTypeModal() {
            $("#modalOverlay").hide();
            $("#employeement_type_modal").hide();

            // Reset state
            currentLayer = 0;
            $("#employeementTypeBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }


        $("#closeEmpType").on("click", function() {
            closeEmployeementTypeModal();
        });
    </script>
@endif
@if ($modal_no == 12)
    <div id="certification_modal" class="side-modal">
        <div class="side-modal-content">
            <div class="modal-header">
                <h3>Certifications</h3>
                <span class="close-btn" id="closeCertificationType" data-close="certification_modal">&times;</span>
                <!-- <div id="childSpecialityContainer"></div> -->
            </div>
            <div id="certificationTypeBody" class="modal-body">
                <div id="layer-0" class="layer" style="display:block;">
                    @foreach ($certification_list as $list)
                        <label class="sub-heading speciality-item" data-id="{{ $list->id }}">
                            <input type="checkbox" name="certification_type[]" class="certification_type_checkbox"
                                value="{{ $list->id }}">
                            <span class="certification-type-name"
                                onclick="loadcertificationType({{ $list->id }}, '{{ $list->name }}')">{{ $list->name }}</span>
                        </label>
                        <div id="child-certification-type-{{ $list->id }}" class="child-container"></div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" onclick="applyCertifications()" class="btn btn-default"> Apply </button>

        </div>
    </div>
    <script>
        var currentLayer = 0;

        function loadcertificationType(parentId, parentName) {


            let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
            if (currentLayerEl) {
                currentLayerEl.style.display = 'none';
            }

            let body = document.getElementById('certificationTypeBody');

            // Create new layer with loader
            currentLayer++;
            let layer = document.createElement('div');
            layer.id = `layer-${currentLayer}`;
            layer.classList.add('layer');
            layer.style.display = 'block';

            let backButton = `<button class="back-btn" onclick="goCertificationBack()">← Back</button>`;
            layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}
                        <div class="loader"></div>`; // loader placeholder

            body.appendChild(layer);

            fetch(`{{ url('/healthcare-facilities/certification-type-child') }}/${parentId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear loader
                    layer.innerHTML = `<div class="breadcrumb">${parentName}</div>${backButton}`;

                    data.forEach(item => {
                        console.log("has_children", item);
                        let clickHandler = item.has_children ?
                            `onclick="loadcertificationType(${item.professionalcert_id}, \`${item.name}\`, ${level + 1})"` :
                            '';
                        layer.innerHTML += `
                        <label class="sub-heading speciality-item" data-id="${item.professionalcert_id}">
                            <input type="checkbox" name="certification_type[]" class="certification_type_checkbox" value="${item.professionalcert_id}">
                            <span class="child-certification-type" ${clickHandler}>${item.name}</span>
                        </label>
                    `;
                    });

                }).catch(() => {
                    layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
                });
        }

        function goCertificationBack() {
            let body = document.getElementById('certificationTypeBody');
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }


        function applyCertifications() {
            let selectedValuesCert = [];
            removePageParam();
            $(".certification_type_checkbox:checked").each(function() {
                selectedValuesCert.push($(this).val());
            });

            $(".normal-pagination").addClass("d-none");
            $(".ajax-pagination").removeClass("d-none");



            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            filters_data.certifications = selectedValuesCert;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log(filters_data);

            //var filters_data1 = sessionStorage.getItem("filters_data");


            fetchNurse(1);


            $("#certification_modal").hide();

            console.log(selectedValuesEmp); // array of selected values
        }

        function closeCertificationModal() {
            $("#modalOverlay").hide();
            $("#certification_modal").hide();

            // Reset state
            currentLayer = 0;
            $("#certificationTypeBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }


        $("#closeCertificationType").on("click", function() {
            closeCertificationModal();
        });
    </script>
@endif
@if ($modal_no == 16)
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <div id="modalOverlay" class="modal-overlay">
        <div id="internationalHiringModal" class="modal-overlay" style="display: none;z-index:99!important">
            <div class="modal-content modal-content-preferences">
                <div class="modal-header">
                    <h4>International hiring</h4>
                    <span class="close-btn" id="closeHiringModal"
                        data-close="internationalHiringModal">&times;</span>
                </div>
                <div class="hiringModalBody modal-body">
                    <div class="international_hiring_drop form-group level-drp">

                        <input type="hidden" class="international_visa" value="hiring" />
                        <ul id="international_hiring" style="display:none;">

                            <li data-value="1">Visa sponsorship available (for nurses already locally registered)</li>
                            <li data-value="2">Overseas-qualified candidates (not yet locally registered)</li>

                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn"
                            data-list-id="international_hiring" name="emr_ehr_data[]" multiple
                            onchange="changeHiring()"></select>
                        <span id='reqsector_preferences' class='reqError text-danger valley'></span>

                    </div>
                    <div class="international_hiring_drop form-group level-drp source_countries"
                        style="display:none;">
                        <label class="form-label" for="input-1">Source countries of interest
                        </label>
                        <input type="hidden" class="international_countires" value="countires" />
                        <ul id="international_countires" style="display:none;">
                            @foreach ($get_countries as $countries)
                                <li data-value="{{ $countries->iso2 }}">{{ $countries->name }}</li>
                            @endforeach
                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn"
                            data-list-id="international_countires" name="emr_ehr_data[]" multiple></select>
                        <span id='reqsector_preferences' class='reqError text-danger valley'></span>

                    </div>
                </div>
                <div class="modal-footer">

                    <button class="apply-btn apply-filter-btn" id="applySector"
                        onclick="applyHiring()">Apply</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        function changeHiring() {
            var selectedValues = $('.js-example-basic-multiple[data-list-id="international_hiring"]').val();

            console.log("selectedValues", selectedValues);

            if (selectedValues.length > 0) {
                $(".source_countries").show();
            } else {
                $(".source_countries").hide();
            }
        }

        function applyHiring() {

            let selectedValuesHiring = $('.js-example-basic-multiple[data-list-id="international_hiring"]').val() || [];
            let selectedValuesCountries = $('.js-example-basic-multiple[data-list-id="international_countires"]').val() ||
            [];

            // Get existing session data
            let filter_data = sessionStorage.getItem("filters_data");
            let filters_data = filter_data ? JSON.parse(filter_data) : {};

            // 🚫 If no hiring selected → clear countries also
            if (selectedValuesHiring.length === 0) {
                selectedValuesCountries = [];
            }

            // ✅ Save clean data
            filters_data.international_hiring = selectedValuesHiring;
            filters_data.international_countries = selectedValuesCountries;

            // Store back to session
            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log("Updated Filters:", filters_data);

            // 🔁 Refresh result
            fetchNurse(1);

            // ❌ Close modal
            closeHiringModal();
        }

        function closeHiringModal() {
            $("#modalOverlay").hide();
            $("#internationalHiringModal").hide();

            // Reset state
            currentLayer = 0;
            $("#hiringModalBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }


        $("#closeHiringModal").on("click", function() {
            closeHiringModal();
        });
    </script>
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
                console.log("dropdown", $currentDropdown);
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
    </script>
@endif
@if ($modal_no == 9)
    <div id="modalOverlay" class="modal-overlay">
        <div id="degreeModal" class="modal-overlay" style="display: none;z-index:99!important">
            <div class="modal-content modal-content-preferences">
                <div class="modal-header">
                    <h4>Education</h4>
                    <span class="close-btn" id="closedegreeModal" data-close="degreeModal">&times;</span>
                </div>
                <div class="degreeModalBody modal-body">
                    <div class="form-group level-drp">



                        <ul id="degreeList" style="display:none;">
                            @foreach ($degree_list as $degree)
                                <li data-value="{{ $degree->id }}">{{ $degree->name }}</li>
                            @endforeach
                        </ul>
                        <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="degreeList"
                            name="emr_ehr_data[]" multiple></select>
                        <span id='reqsector_preferences' class='reqError text-danger valley'></span>

                    </div>

                </div>
                <div class="modal-footer">

                    <button class="apply-btn apply-filter-btn" id="applyDegree"
                        onclick="applyDegree()">Apply</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        function closeCertificationModal() {
            $("#modalOverlay").hide();
            $("#certification_modal").hide();

            // Reset state
            currentLayer = 0;
            $("#certificationTypeBody .layer").not("#layer-0").remove();
            $("#layer-0").show();
        }

        function applyDegree() {
            var degreeValues = $('.js-example-basic-multiple[data-list-id="degreeList"]').val();

            var filter_data = sessionStorage.getItem("filters_data");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            filters_data.degrees = degreeValues;

            sessionStorage.setItem("filters_data", JSON.stringify(filters_data));

            console.log(filters_data);

            //var filters_data1 = sessionStorage.getItem("filters_data");


            fetchNurse(1);


            closeCertificationModal();
        }


        $("#closeCertificationType").on("click", function() {
            closeCertificationModal();
        });
    </script>
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
                console.log("dropdown", $currentDropdown);
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
        const clearButton1 = $('<span class="clear-btn">✖</span>');
        $('.select2-container').append(clearButton1);

        // Handle the visibility of the clear button
        function toggleClearButton() {

            const selectedOptions = $('.js-example-basic-multiple').val();
            if (selectedOptions && selectedOptions.length > 0) {
                clearButton1.show();
            } else {
                clearButton1.hide();
            }
        }

        // Attach change event to select2
        $('.js-example-basic-multiple').on('change', toggleClearButton);

        // Clear button click event
        clearButton1.click(function() {

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
    </script>
@endif
