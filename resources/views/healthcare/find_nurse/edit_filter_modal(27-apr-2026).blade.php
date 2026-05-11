<style>
    .layer {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    min-height: 100%;
    background: #fff; 
    display: none;
    padding: 10px;
}
.ui-slider-handle {
    width: 22px !important;
    height: 22px !important;
    background: #fff !important;
    border: 2px solid #000000 !important;
    border-radius: 6px !important;
    top: -8px !important;
    cursor: pointer;
    outline: none;
}

#editSalary_expect .ui-slider-handle{
    display: block !important;
}

.salary-container {
  width: 400px;
  margin: 40px auto;
  text-align: center;
}

/* Slider track */
#salary-slider {
  margin: 30px 20px;
  height: 6px;
  background: #ddd;
  border: none;
  border-radius: 5px;
}

.ui-slider-handle::after {
  content: "";
  width: 10px;
  height: 10px;
  background: #000000;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* Hover effect */
.ui-slider-handle:hover {
  transform: scale(1.1);
}

/* Salary text */
.salary-text {
  margin-top: 15px;
  font-size: 18px;
}

/* Selected range */
.ui-slider-range {
  background: #000000;
  height: 100%;
  border-radius: 5px;
}
</style>
@if($modal_no == 2)
 <div id="editmodalOverlay" class="modal-overlay">
    <div id="specialtyModal" class="side-modal">
        <div class="side-modal-content">
            <div class="modal-header">
                <h3>Type of Specialty</h3>
                   <button class="back-btn" id="backToEditFilter">← Back</button>
                <!-- <span class="close-btn" id="closespecialty" data-close="specialtyModal">&times;</span> -->
            </div>
            <div id="specialtyBody" class="modal-body">
                <div id="layer-0" class="layer" style="display:block;">
                    @foreach($specialty_list as $list)
                        @if($list->parent == 0)
                            <label class="sub-heading specialty-item" data-id="{{ $list->id }}">
                                <input type="checkbox" id="speciality-category-checked" class="specialty-checkbox" name="specialty[]" value="{{ $list->id }}">
                                <span class="specialty-name" onclick="loadChildspecialty({{ $list->id }}, '{{ $list->name }}')">
                                    {{ $list->name }}
                                </span>
                            </label>
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var currentLayer = 0;
    var selectedspecialtys = [];

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('specialty-checkbox')) {
            let value = e.target.value;
            var filter_data = sessionStorage.getItem("filters_data_saved");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            if (e.target.checked) {
                if (!selectedspecialtys.includes(value)) {
                    selectedspecialtys.push(value);
                }
            } else {
                selectedspecialtys = selectedspecialtys.filter(v => v !== value);
            }

            filters_data.specialty_type = selectedspecialtys;
            sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));
        }
    });


    function loadChildspecialty(parentId, parentName) {
        let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
        if (currentLayerEl) currentLayerEl.style.display = 'none';

        // Hide the static back button when going inside
        document.getElementById('backToEditFilter').style.display = 'none';

        let body = document.getElementById('specialtyBody');
        currentLayer++;

        let layer = document.createElement('div');
        layer.id = `layer-${currentLayer}`;
        layer.classList.add('layer');
        layer.style.display = 'block';

        // Only the dynamic back button here
        layer.innerHTML = `
            <div class="breadcrumb">${parentName}</div>
            <button class="back-btn" onclick="goBack()">← Back</button>
            <br><div class="loader"></div>
        `;

        body.appendChild(layer);

        fetch(`{{ url('/healthcare-facilities/speciality-child') }}/${parentId}`)
            .then(response => response.json())
            .then(data => {
                layer.innerHTML = `
                    <div class="breadcrumb">${parentName}</div>
                    <button class="back-btn" onclick="goBack()">← Back</button><br>
                `;
                data.forEach(item => {
                    let isChecked = selectedspecialtys.includes(item.id.toString()) ? 'checked' : '';
                    let clickHandler = item.has_children 
                        ? `onclick="loadChildspecialty(${item.id}, '${item.name}')"` 
                        : '';

                    layer.innerHTML += `
                        <label class="sub-heading specialty-item" data-id="${item.id}">
                            <input type="checkbox" name="specialty[]" class="specialty-checkbox" value="${item.id}" ${isChecked}>
                            <span class="specialty-name" ${clickHandler}>${item.name}</span>
                        </label><br>
                    `;
                });
            })
            .catch(() => {
                layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
            });
    }

    function goBack() {
        let body = document.getElementById('specialtyBody');

        if (currentLayer > 0) {
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;

                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }

            // If we are back at root, show static back button again
            if (currentLayer === 0) {
                document.getElementById('backToEditFilter').style.display = 'inline-block';
            }
        }
    }

</script>
@endif
@if($modal_no == 8)
<div class="modal-overlay" id="editSalary_expect">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Salary Expectations</h4>
            <button type="button" class="btn-close" onclick="closeSalaryModal()" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="form-group level-drp">       
                <div id="salary-slider-edit"></div>
                <p style="margin-top:10px;">
                    $<span id="minSalary">41600</span> -
                    $<span id="maxSalary">312000</span> 
                </p>                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="applySalaryExpectation()" class="btn btn-default">Apply</button>
        </div>
    </div>
</div>
<script>
    // Show modal and initialize slider
    $(document).on('click', '.salary-expect', function () {
        let $btn = $(this); 
        $btn.css('pointer-events', 'none');

        $('#editmodalContainer').empty();
        $('#globalLoader').show();

        $.ajax({
            url: "{{ url('/healthcare-facilities/commonModalEdit') }}",
            type: "GET",
            data: { modal_no: 8 },
            success: function (response) {
                $('#editmodalContainer').html(response);

                // Show modal
                $('#editSalary_expect').fadeIn();

                // Get saved values if available
                let filters_data = JSON.parse(sessionStorage.getItem('filters_data_saved')) || {};
                let minVal = filters_data.salary?.min || 41600;
                let maxVal = filters_data.salary?.max || 312000;

                // Initialize slider with saved or default values
                $("#salary-slider").slider({
                    range: true,
                    min: 41600,
                    max: 312000,
                    step: 1000,
                    values: [minVal, maxVal],

                    slide: function (event, ui) {
                        $("#minSalary").text(ui.values[0]);
                        $("#maxSalary").text(ui.values[1]);
                    },

                    change: function (event, ui) {
                        let filters_data = JSON.parse(sessionStorage.getItem('filters_data_saved')) || {};
                        filters_data.salary = {
                            min: ui.values[0],
                            max: ui.values[1]
                        };
                        sessionStorage.setItem('filters_data_saved', JSON.stringify(filters_data));
                    }
                });

                // Update labels initially
                $("#minSalary").text(minVal);
                $("#maxSalary").text(maxVal);

                $btn.css('pointer-events', 'auto');
                $('#globalLoader').hide();
            }
        });
    });

    // Close modal
    function closeSalaryModal() {
        $('#editSalary_expect').hide();
    }

    // Apply button saves and closes
    function applySalaryExpectation() {
        let values = $("#salary-slider").slider("values");
        let minSalary = parseInt(values[0]);
        let maxSalary = parseInt(values[1]);

        let filters_data = JSON.parse(sessionStorage.getItem('filters_data_saved')) || {};
        filters_data.salary = { min: minSalary, max: maxSalary };

        sessionStorage.setItem('filters_data_saved', JSON.stringify(filters_data));

        $('#editSalary_expect').hide();
        fetchNurse();
    }

</script>
@endif
@if($modal_no == 10)
  <div class="modal-overlay" id="editCheck_clearances" >
        <div class="modal-content">
        <div class="modal-header">
            <h4>Checks & Clearances</h4>
            <button type="button" class="btn-close" onclick="removeClearances()" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <label class="mb-2">Select Checks</label>
            <ul id="checks_filter" class="list-unstyled">
                <li class="mb-2">
                    <label class="d-flex align-items-center">
                    <input type="checkbox" name="checks[]" value="ndis" class="me-2">
                    NDIS Worker Screening Check
                    </label>
                </li>
                <li class="mb-2">
                    <label class="d-flex align-items-center">
                    <input type="checkbox" name="checks[]" value="wwcc" class="me-2">
                    Working With Children Check (WWCC)
                    </label>
                </li>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="removeClearances()" class="btn btn-default"> Apply </button>
        </div>
        </div>
  </div>
<script>
    // Handle click on each checkbox
    $(document).on('change', 'input[name="checks[]"]', function () {
        let selectedChecks = new Set();

        // Collect checked values (unique automatically)
        $('input[name="checks[]"]:checked').each(function () {
            selectedChecks.add($(this).val());
        });

        // Convert Set to Array
        selectedChecks = Array.from(selectedChecks);

        // Get existing filters
        var filter_data = sessionStorage.getItem("filters_data_saved");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Update value
        filters_data.check_clearance = selectedChecks;

        // Save back
        sessionStorage.setItem('filters_data_saved', JSON.stringify(filters_data));
    });

    $(document).ready(function () {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (filter_data) {
            var filters_data = JSON.parse(filter_data);
            if (filters_data.check_clearance) {
                $('input[name="checks[]"]').each(function () {
                    $(this).prop('checked', filters_data.check_clearance.includes($(this).val()));
                });
            }
        }
    });

    function removeClearances() {
        // Close modal
        $("#editCheck_clearances").hide();
    }

</script>
@endif
@if($modal_no == 4)
  <div class="modal-overlay" id="editYearExperience" >
        <div class="modal-content">
        <div class="modal-header">
            <h4>Years of Experience</h4>
            <button type="button" class="btn-close" onclick="removeExperience()" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
             <select class="form-control assistent_level" name="assistent_level">
                <option value="">Please Select</option>
                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}" @if(!empty($user_data) && $user_data->assistent_level == $i) selected @endif>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year</option>
                @endfor
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="removeExperience()" class="btn btn-default"> Apply </button>
        </div>
        </div>
  </div>
<script>
    $(document).on('change', 'select[name="assistent_level"]', function () {
        let selectedYearExp = $(this).val();

        // Retrieve existing filters from sessionStorage
        var filter_data = sessionStorage.getItem("filters_data_saved");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Save year of experience into filters_data
        filters_data.year_experience = selectedYearExp;

        // Update sessionStorage
        sessionStorage.setItem('filters_data_saved', JSON.stringify(filters_data));

        // Optional: trigger your fetch function immediately

    });

    $(document).ready(function () {
        var filter_data = sessionStorage.getItem("filters_data_saved");
        if (filter_data) {
            var filters_data = JSON.parse(filter_data);
            if (filters_data.year_experience) {
                $('select[name="assistent_level"]').val(filters_data.year_experience);
            }
        }
    });

    function removeExperience() {
        // Close modal
        $("#editYearExperience").hide();
    }

</script>
@endif
@if($modal_no == 13)
  <div class="modal-overlay" id="languageModal"  >
        <div class="modal-content">
        <div class="modal-header">
            <h4>Language Filter</h4>
            <span class="close-btn" id="closelanguage" onclick="removeLanguage()" data-close="languageModal">&times;</span>
        </div>
        <div class="modal-body">
            <label for="agency">Language Skills</label>
                <ul id="language_filter" style="display:none;">                           
                @if(!empty($language_skill))
                @foreach ($language_skill as $language)
                <li data-value="{{ $language->language_id }}">{{ $language->language_name }}</li>
                @endforeach
                @endif
                </ul>
                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="language_filter" name="language_ids[]" multiple></select>
            <label for="agency">Specialized Language Skills</label>
                <ul id="language_spec" style="display:none;">                           
                @if(!empty($specialized_lang_skills))
                @foreach ($specialized_lang_skills as $spec_language)
                <li data-value="{{ $spec_language->language_id }}">{{ $spec_language->language_name }}</li>
                @endforeach
                @endif
                </ul>
                <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="language_spec" name="language_ids[]" multiple></select>
            <!-- <label for="language">Specialized Language Skills</label>
            <input type="text" name="language_skill"> -->
        </div>
        <div class="modal-footer">
            <button type="button" onclick="removeLanguage()" class="btn btn-default"> Apply </button>
        </div>
        </div>
  </div>

<script>
    // ✅ Unified state object (declared once globally)
    if (typeof selectedFilters === "undefined") {
        var selectedFilters = {
            nurse_type: [],
            employment_type: [],
            shiftType: [],
            language: []
        };
    }

    // ✅ Change handler for language dropdowns
    $(document).on('change', '.js-example-basic-multiple', function () {
        let selectedValues = [];

        $(".js-example-basic-multiple").each(function () {
            let vals = $(this).val(); // array of selected IDs
            if (vals) {
                selectedValues = selectedValues.concat(vals);
            }
        });

        // Get existing filters from session
        var filter_data = sessionStorage.getItem("filters_data_saved");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Save combined language IDs
        selectedFilters.language = selectedValues;
        filters_data.language = selectedFilters.language;

        sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));

        console.log("filters_data_saved (language)", filters_data);
    });

    // ✅ Apply button (still needed for triggering fetch + closing modal)
    function removeLanguage() {
        // Close modal
        $("#languageModal").hide();
    }

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
            console.log("dropdown",$currentDropdown);
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
    var clearButtonShow = $('<span class="clear-btn">✖</span>');
    $('.select2-container').append(clearButtonShow);

    // Handle the visibility of the clear button
    function toggleClearButtonShow() {

        var selectedOptions = $('.js-example-basic-multiple').val();
        if (selectedOptions && selectedOptions.length > 0) {
            clearButtonShow.show();
        } else {
            clearButtonShow.hide();
        }
    }

    // Attach change event to select2
    $('.js-example-basic-multiple').on('change', toggleClearButtonShow);

    // Clear button click event
    clearButtonShow.click(function() {

        $('.js-example-basic-multiple').val(null).trigger('change');
        toggleClearButtonShow();
    });

    // Initial check
    toggleClearButtonShow();
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

@endif

@if($modal_no == 6)
 <div id="editmodalOverlay" class="modal-overlay">
    <div id="employeement_type_modal" class="side-modal">
        <div class="side-modal-content">
            <div class="modal-header">
                <h3>Employment Type</h3>
                     <button class="back-btn" id="backToEditFilter">← Back</button>
                <!-- <span class="close-btn" id="closeEmpType" data-close="employeement_type_modal">&times;</span> -->
                <!-- <div id="childSpecialityContainer"></div> -->
            </div>
            <div id="employeementTypeBody" class="modal-body">
                <div id="layer-0" class="layer" style="display:block;">
                    @foreach($employeement_type_list as $list)
                    <label class="sub-heading speciality-item" data-id="{{ $list->emp_prefer_id }}">
                        <input type="checkbox" name="employment_type[]" class="employeement_type_checkbox" value="{{ $list->emp_prefer_id }}">
                        <span class="employeement-type-name" onclick="loadEmployeementType({{ $list->emp_prefer_id }}, '{{ $list->emp_type }}')">{{ $list->emp_type }}</span>
                    </label>
                    <div id="child-employeement-type-{{ $list->emp_prefer_id }}" class="child-container"></div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
 </div>
 <script>
    var currentLayer = 0;
    var selectedFilters = {
        nurse_type: [],
        employment_type: []
    };

    // ✅ Unified change handler
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('nurseType-checkbox') || e.target.classList.contains('employeement_type_checkbox')) {
            let value = e.target.value;
            let type = e.target.name.replace("[]", ""); // nurse_type or employment_type

            var filter_data = sessionStorage.getItem("filters_data_saved");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            if (e.target.checked) {
                if (!selectedFilters[type].includes(value)) {
                    selectedFilters[type].push(value);
                }
            } else {
                selectedFilters[type] = selectedFilters[type].filter(v => v !== value);
            }

            filters_data[type] = selectedFilters[type];
            sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));
        }
    });

    // ✅ Employment type loader
    function loadEmployeementType(parentId, parentName, level = 1) {
        let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
        if (currentLayerEl) currentLayerEl.style.display = 'none';
        document.getElementById('backToEditFilter').style.display = 'none';

        let body = document.getElementById('employeementTypeBody'); // fixed: use explicit body id
        currentLayer++;

        let layer = document.createElement('div');
        layer.id = `layer-${currentLayer}`;
        layer.classList.add('layer');
        layer.style.display = 'block';

        layer.innerHTML = `
            <div class="breadcrumb">${parentName}</div>
            <button class="back-btn" onclick="goBack('employeementTypeBody')">← Back</button>
            <br><div class="loader"></div>
        `;

        body.appendChild(layer);

        fetch(`{{ url('/healthcare-facilities/employment-type-child') }}/${parentId}?level=${level}`)
            .then(response => response.json())
            .then(data => {
                layer.innerHTML = `
                    <div class="breadcrumb">${parentName}</div>
                    <button class="back-btn" onclick="goBack('employeementTypeBody')">← Back</button><br>
                `;

                data.forEach(item => {
                    let isChecked = selectedFilters.employment_type.includes(item.emp_prefer_id.toString()) ? 'checked' : '';
                    let clickHandler = item.has_children 
                        ? `onclick="loadEmployeementType(${item.emp_prefer_id}, '${item.emp_type}', ${level + 1})"` 
                        : '';

                    layer.innerHTML += `
                        <label class="sub-heading speciality-item" data-id="${item.emp_prefer_id}">
                            <input type="checkbox" name="employment_type[]" class="employeement_type_checkbox" value="${item.emp_prefer_id}" ${isChecked}>
                            <span class="employment-type-name" ${clickHandler}>${item.emp_type}</span>
                        </label><br>
                    `;
                });
            })
            .catch(() => {
                layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
            });
    }

    // ✅ Back function works for both nurse and employment
    function goBack(bodyId) {
        let body = document.getElementById(bodyId);
        document.getElementById('backToEditFilter').style.display = 'block';
        if (currentLayer > 0) {
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }
    }
</script>
@endif

@if($modal_no == 1)
 <div id="editmodalOverlay" class="modal-overlay">
    <div id="nurseTypeModal" class="side-modal">
        <div class="side-modal-content">
            <div class="modal-header">
                <h3>Type of Nurse</h3>
                   <button class="back-btn" id="backToEditFilter">← Back</button>
                <!-- <span class="close-btn" id="closenurseType" data-close="nurseTypeModal">&times;</span> -->
            </div>
            <div id="nurseTypeBody" class="modal-body">
                <div id="layer-0" class="layer" style="display:block;">
                    @foreach($nurseType_list as $list)
                        @if($list->parent == 0)
                            <label class="sub-heading nurseType-item" data-id="{{ $list->id }}">
                                <!-- <input type="checkbox" name="nurseType[]" value="{{ $list->id }}"> -->
                                <input type="checkbox" id="main-category-checked" class="nurseType-checkbox" name="nurseType[]" value="{{ $list->id }}">
                                <span class="nurseType-name" onclick="loadChildnurseType({{ $list->id }}, '{{ $list->name }}')">
                                    {{ $list->name }}
                                </span>
                            </label>
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var currentLayer = 0;
    var selectedNurseTypes = [];

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('nurseType-checkbox')) {
            let value = e.target.value;
            var filter_data = sessionStorage.getItem("filters_data_saved");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            if (e.target.checked) {
                if (!selectedNurseTypes.includes(value)) {
                    selectedNurseTypes.push(value);
                }
            } else {
                selectedNurseTypes = selectedNurseTypes.filter(v => v !== value);
            }

            filters_data.nurse_type = selectedNurseTypes;
            sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));
        }
    });

    function backToEditFilterModal() {
        document.getElementById('nurseTypeModal').style.display = 'none';
        document.getElementById('nursemodalOverlay').style.display = 'none';
        document.getElementById('verticalFilterModal').style.display = 'block';
        document.getElementById('EditMoalOverlay').style.display = 'block';
    }

    function loadChildnurseType(parentId, parentName) {
        let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
        if (currentLayerEl) currentLayerEl.style.display = 'none';
         document.getElementById('backToEditFilter').style.display = 'none';

        let body = document.getElementById('nurseTypeBody');

        currentLayer++;

        let layer = document.createElement('div');
        layer.id = `layer-${currentLayer}`;
        layer.classList.add('layer');
        layer.style.display = 'block';

        // ✅ Subcategory back button uses goBack()
        layer.innerHTML = `
            <div class="breadcrumb">${parentName}</div>
            <button class="back-btn" onclick="goBack()">← Back</button>
            <br><div class="loader"></div>
        `;

        body.appendChild(layer);

        fetch(`{{ url('/healthcare-facilities/nurseType-child') }}/${parentId}`)
            .then(response => response.json())
            .then(data => {
                layer.innerHTML = `
                    <div class="breadcrumb">${parentName}</div>
                    <button class="back-btn" onclick="goBack()">← Back</button><br>
                `;

                data.forEach(item => {
                    let isChecked = selectedNurseTypes.includes(item.id.toString()) ? 'checked' : '';
                    let clickHandler = item.has_children 
                        ? `onclick="loadChildnurseType(${item.id}, '${item.name}')"` 
                        : '';

                    layer.innerHTML += `
                        <label class="sub-heading nurseType-item" data-id="${item.id}">
                            <input type="checkbox" name="nurseType[]" class="nurseType-checkbox" value="${item.id}" ${isChecked}>
                            <span class="nurseType-name" ${clickHandler}>${item.name}</span>
                        </label><br>
                    `;
                });
            })
            .catch(() => {
                layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
            });
    }

    function goBack() {
        let body = document.getElementById('nurseTypeBody');
        document.getElementById('backToEditFilter').style.display = 'block';
        if (currentLayer > 0) {
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;

                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }
    }
</script>
@endif


@if($modal_no == 7)
<div id="editmodalOverlay" class="modal-overlay">
    <div id="shiftTypeModal" class="side-modal">
        <div class="side-modal-content">
            <div class="modal-header">
                <h3>Shift Type</h3>
                  <button class="back-btn" id="backToEditFilter">← Back</button>
                <!-- <span class="close-btn" id="closeshiftType" data-close="shiftTypeModal">&times;</span> -->
            </div>
            <div id="shiftTypeBody" class="modal-body">
                <div id="layer-0" class="layer" style="display:block;">
                    @foreach($shiftType_list as $list)
                        @if($list->parent == 0)
                            <label class="sub-heading shiftType-item" data-id="{{ $list->work_shift_id }}">
                                <!-- <input type="checkbox" name="shiftType[]" value="{{ $list->work_shift_id }}"> -->
                                <input type="checkbox" class="shiftType-checkbox" name="shiftType[]" value="{{ $list->work_shift_id }}">
                                <span class="shiftType-name" onclick="loadChildshiftType({{ $list->work_shift_id }}, '{{ $list->shift_name }}')">
                                    {{ $list->shift_name }}
                                </span>
                            </label>
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var currentLayer = 0;
    var selectedFilters = {
        nurse_type: [],
        employment_type: [],
        shiftType: []
    };

    // ✅ Unified change handler
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('nurseType-checkbox') || 
            e.target.classList.contains('employeement_type_checkbox') || 
            e.target.classList.contains('shiftType-checkbox')) {

            let value = e.target.value;
            let type = e.target.name.replace("[]", ""); // nurse_type, employment_type, or shiftType

            var filter_data = sessionStorage.getItem("filters_data_saved");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            if (e.target.checked) {
                if (!selectedFilters[type].includes(value)) {
                    selectedFilters[type].push(value);
                }
            } else {
                selectedFilters[type] = selectedFilters[type].filter(v => v !== value);
            }

            filters_data[type] = selectedFilters[type];
            sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));
        }
    });

    // ✅ Shift type loader with level param
    function loadChildshiftType(parentId, parentName, level = 1) {
        let currentLayerEl = document.getElementById(`layer-${currentLayer}`);
        if (currentLayerEl) currentLayerEl.style.display = 'none';
        document.getElementById('backToEditFilter').style.display = 'none';

        let body = document.getElementById('shiftTypeBody');
        currentLayer++;

        let layer = document.createElement('div');
        layer.id = `layer-${currentLayer}`;
        layer.classList.add('layer');
        layer.style.display = 'block';

        layer.innerHTML = `
            <div class="breadcrumb">${parentName}</div>
            <button class="back-btn" onclick="goBack('shiftTypeBody')">← Back</button>
            <br><div class="loader"></div>
        `;

        body.appendChild(layer);

        fetch(`{{ url('/healthcare-facilities/shiftType-child') }}/${parentId}?level=${level}`)
            .then(response => response.json())
            .then(data => {
                layer.innerHTML = `
                    <div class="breadcrumb">${parentName}</div>
                    <button class="back-btn" onclick="goBack('shiftTypeBody')">← Back</button><br>
                `;

                data.forEach(item => {
                    let isChecked = selectedFilters.shiftType.includes(item.work_shift_id.toString()) ? 'checked' : '';
                    let clickHandler = item.has_children 
                        ? `onclick="loadChildshiftType(${item.work_shift_id}, '${item.shift_name}', ${level + 1})"` 
                        : '';

                    layer.innerHTML += `
                        <label class="sub-heading shiftType-item" data-id="${item.work_shift_id}">
                            <input type="checkbox" name="shiftType[]" class="shiftType-checkbox" value="${item.work_shift_id}" ${isChecked}>
                            <span class="shiftType-name" ${clickHandler}>${item.shift_name}</span>
                        </label><br>
                    `;
                });
            })
            .catch(() => {
                layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
            });
    }

    // ✅ Back function
    function goBack(bodyId) {
        let body = document.getElementById(bodyId);
        document.getElementById('backToEditFilter').style.display = 'block';
        if (currentLayer > 0) {
            let current = document.getElementById(`layer-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }
    }
</script>

@endif
@if($modal_no == 23)
  <div class="modal-overlay" id="editRegistration" >
        <div class="modal-content">
        <div class="modal-header">
            <h4>Registration & Licences</h4>
            <span class="close-btn" id="closeregistration" onclick="removeregistration()" data-close="registrationModal">&times;</span>
        </div>
        <div class="modal-body">
            <div class="form-group level-drp">
                            
                            
                            
                            <ul id="licenses" style="display:none;">
                                
                                <li data-value="1">NDIS-registered provider</li>
                                <li data-value="2">Bills under Medicare / MBS (NP/Midwife)</li>
                                <li data-value="3">PBS Prescriber</li>
                                <li data-value="4">Immunisation Provider</li>
                                <li data-value="5">Uses radiation equipment</li>
                                
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="licenses" name="licenses[]" multiple></select>
                            
                            
                        </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="removeregistration()" class="btn btn-default"> Apply </button>
        </div>
        </div>
  </div>

<script>
    // ✅ Unified state object (declared once globally)
    if (typeof selectedFilters === "undefined") {
        var selectedFilters = {
            nurse_type: [],
            employment_type: [],
            shiftType: [],
            language: []
        };
    }

    // ✅ Change handler for language dropdowns
    $(document).on('change', '.js-example-basic-multiple', function () {
        let selectedValues = [];

        $(".js-example-basic-multiple").each(function () {
            let vals = $(this).val(); // array of selected IDs
            if (vals) {
                selectedValues = selectedValues.concat(vals);
            }
        });

        // Get existing filters from session
        var filter_data = sessionStorage.getItem("filters_data_saved");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Save combined language IDs
        selectedFilters.language = selectedValues;
        filters_data.language = selectedFilters.language;

        sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));

        console.log("filters_data_saved (language)", filters_data);
    });

    // ✅ Apply button (still needed for triggering fetch + closing modal)
    function removeregistration() {

        // 1️⃣ Close Select2 dropdown if open
        $('.js-example-basic-multiple').select2('close');

        // 2️⃣ Remove Select2 wheel event (if you added namespace)
        $(document).off('wheel.select2fix');

        // 3️⃣ Destroy Select2 (VERY IMPORTANT for dynamic modals)
        $('.js-example-basic-multiple').each(function () {
            if ($(this).data('select2')) {
                $(this).select2('destroy');
            }
        });

        // 4️⃣ Clear modal content (prevents duplicate bindings)
        $('#editmodalContainer').empty();

        // 5️⃣ Restore body scroll (if it was blocked)
        $('body').css('overflow', 'auto');
        // Close modal
        $("#editRegistration").hide();
    }

</script>



@endif

@if($modal_no == 3)
<div id="editmodalOverlay" class="modal-overlay">
    <div id="workEnvironmentSavedModal" class="side-modal">
        <div class="side-modal-content">
            <div class="modal-header">
                <h3>Work Environment</h3>
                <button class="back-btn" id="backToEditFilter">← Back</button>
                <!-- <span class="close-btn" id="closeEmpType" data-close="employeement_type_modal">&times;</span> -->
                <!-- <div id="childSpecialityContainer"></div> -->
            </div>
            <div id="workEnvironmentBody" class="modal-body">
                <div id="layer1-0" class="layer" style="display:block;">
                    @foreach($work_environment_list as $list)
                    <label class="sub-heading nurseType-item" data-id="{{ $list->prefer_id }}">
                        <!-- <input type="checkbox" name="nurseType[]" value="{{ $list->id }}"> -->
                        <input type="checkbox" id="main-category-checked" class="workEnvironment-checkbox" name="workEnvironment[]" value="{{ $list->prefer_id }}">
                        <span class="work-environment-name" onclick="loadChildWorkEnvironment({{ $list->prefer_id }}, '{{ $list->env_name }}')">
                            {{ $list->env_name }}
                        </span>
                    </label>
                    <div id="child-work-environment-{{ $list->prefer_id }}" class="child-container"></div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
 </div>

<script>
    var currentLayer = 0;
    let selectedFiltersWorkEnv = {
        nurse_type: [],
        employment_type: [],
        workEnvironment:[]
    };

    // ✅ Unified change handler
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('nurseType-checkbox') || e.target.classList.contains('employeement_type_checkbox') || e.target.classList.contains('workEnvironment-checkbox')) {
            let value = e.target.value;
            
            let type = e.target.name.replace("[]", ""); // nurse_type or employment_type
            //alert(type);    
            var filter_data = sessionStorage.getItem("filters_data_saved");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            if (e.target.checked) {
                if (!selectedFiltersWorkEnv[type].includes(value)) {
                    selectedFiltersWorkEnv[type].push(value);
                }
            } else {
                selectedFiltersWorkEnv[type] = selectedFiltersWorkEnv[type].filter(v => v !== value);
            }

            filters_data[type] = selectedFiltersWorkEnv[type];
            sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));
        }
    });

    // ✅ Employment type loader
    function loadChildWorkEnvironment(parentId, parentName, level = 1) {
        
        let currentLayerEl = document.getElementById(`layer-0`);
        let currentLayerEl1 = document.getElementById(`layer1-${currentLayer}`);
        //console.log("currentLayerEl",currentLayerEl);
        if (currentLayerEl1) {
            //alert(currentLayer);
            currentLayerEl.style.display = 'none';
            currentLayerEl1.style.display = 'none';
        }
        document.getElementById('backToEditFilter').style.display = 'none';

        let body = document.getElementById('workEnvironmentBody'); // fixed: use explicit body id
        currentLayer++;

        let layer = document.createElement('div');
        layer.id = `layer1-${currentLayer}`;
        layer.classList.add('layer');
        layer.style.display = 'block';

        layer.innerHTML = `
            <div class="breadcrumb">${parentName}</div>
            <button class="back-btn" onclick="goBack('workEnvironmentBody')">← Back</button>
            <br><div class="loader"></div>
        `;

        body.appendChild(layer);

        fetch(`{{ url('/healthcare-facilities/work-environment-child') }}/${parentId}?level=${level}`)
            .then(response => response.json())
            .then(data => {
                layer.innerHTML = `
                    <div class="breadcrumb">${parentName}</div>
                    <button class="back-btn" onclick="goBack('workEnvironmentBody')">← Back</button><br>
                `;

                data.forEach(item => {
                    //let isChecked = selectedFilters.employment_type.includes(item.emp_prefer_id.toString()) ? 'checked' : '';
                    let clickHandler = item.has_children 
                        ? `onclick="loadChildWorkEnvironment(${item.prefer_id}, '${item.env_name}', ${level + 1})"` 
                        : '';

                    layer.innerHTML += `
                        <label class="sub-heading nurseType-item" data-id="${item.prefer_id}">
                            <input type="checkbox" name="workEnvironment[]" class="workEnvironment-checkbox" value="${item.prefer_id}">
                            <span class="workEnvironment-name" ${clickHandler}>${item.env_name}</span>
                        </label>
                        <br>
                    `;
                });
            })
            .catch(() => {
                layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
            });
    }

    // ✅ Back function works for both nurse and employment
    function goBack(bodyId) {
        let body = document.getElementById(bodyId);
        if(currentLayer == 1){
            document.getElementById('backToEditFilter').style.display = 'block';
            $("#layer-0").show();
        }
        if (currentLayer > 0) {
            let current = document.getElementById(`layer1-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer1-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }
    }
</script>
@endif
@if($modal_no == 12)
<div id="editmodalOverlay" class="modal-overlay">
    <div id="certificatonSavedModal" class="side-modal">
        <div class="side-modal-content">
            <div class="modal-header">
                <h3>Certifications</h3>
                <button class="back-btn" id="backToEditFilter">← Back</button>
                <!-- <span class="close-btn" id="closeEmpType" data-close="employeement_type_modal">&times;</span> -->
                <!-- <div id="childSpecialityContainer"></div> -->
            </div>
            <div id="certificationBody" class="modal-body">
                <div id="layer1-0" class="layer" style="display:block;">
                    @foreach($certification_edit as $list)
                    <label class="sub-heading nurseType-item" data-id="{{ $list->id }}">
                        <!-- <input type="checkbox" name="nurseType[]" value="{{ $list->id }}"> -->
                        <input type="checkbox" id="main-category-checked" class="certification-checkbox" name="certification[]" value="{{ $list->id }}">
                        <span class="certification-name" onclick="loadChildCertification({{ $list->id }}, '{{ $list->name }}')">
                            {{ $list->name }}
                        </span>
                    </label>
                    <div id="child-certification-{{ $list->id }}" class="child-container"></div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
 </div>

<script>
    var currentLayer = 0;
    let selectedFiltersCert = {
        nurse_type: [],
        employment_type: [],
        workEnvironment:[],
        certification:[]
    };

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('certification-checkbox')) {
            let value = e.target.value;
            let type = e.target.name.replace("[]", ""); // nurse_type or employment_type
            var filter_data = sessionStorage.getItem("filters_data_saved");
            var filters_data = filter_data ? JSON.parse(filter_data) : {};

            if (e.target.checked) {
                if (!selectedFiltersCert[type].includes(value)) {
                    selectedFiltersCert[type].push(value);
                }
            } else {
                selectedFiltersCert[type] = selectedFiltersCert[type].filter(v => v !== value);
            }

            filters_data[type] = selectedFiltersCert[type];
            sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));
        }
    });

    function backToEditFilterModal() {
        document.getElementById('nurseTypeModal').style.display = 'none';
        document.getElementById('nursemodalOverlay').style.display = 'none';
        document.getElementById('verticalFilterModal').style.display = 'block';
        document.getElementById('EditMoalOverlay').style.display = 'block';
    }

    function loadChildCertification(parentId, parentName) {
        let currentLayerEl = document.getElementById(`layer-0`);
        let currentLayerEl1 = document.getElementById(`layer1-${currentLayer}`);
        //console.log("currentLayerEl",currentLayerEl);
        if (currentLayerEl1) {
            //alert(currentLayer);
            currentLayerEl.style.display = 'none';
            currentLayerEl1.style.display = 'none';
        }
        document.getElementById('backToEditFilter').style.display = 'none';

        let body = document.getElementById('certificationBody');

        currentLayer++;

        let layer = document.createElement('div');
        layer.id = `layer1-${currentLayer}`;
        layer.classList.add('layer1');
        layer.style.display = 'block';

        // ✅ Subcategory back button uses goBack()
        layer.innerHTML = `
            <div class="breadcrumb">${parentName}</div>
            <button class="back-btn" onclick="goBack('certificationBody')">← Back</button>
            <br><div class="loader"></div>
        `;

        body.appendChild(layer);

        fetch(`{{ url('/healthcare-facilities/certification-type-child') }}/${parentId}`)
            .then(response => response.json())
            .then(data => {
                layer.innerHTML = `
                    <div class="breadcrumb">${parentName}</div>
                    <button class="back-btn" onclick="goBack('certificationBody')">← Back</button><br>
                `;

                data.forEach(item => {
                    let isChecked = selectedFiltersCert.certification.includes(item.professionalcert_id.toString()) ? 'checked' : '';
                    let clickHandler = item.has_children 
                        ? `onclick="loadChildCertification(${item.professionalcert_id}, '${item.name}')"` 
                        : '';

                    layer.innerHTML += `
                        <label class="sub-heading nurseType-item" data-id="${item.professionalcert_id}">
                            <input type="checkbox" name="certification[]" class="certification-checkbox" value="${item.professionalcert_id}" ${isChecked}>
                            <span class="certification-name" ${clickHandler}>${item.name}</span>
                        </label><br>
                    `;
                });
            })
            .catch(() => {
                layer.innerHTML += `<div class="loader">❌ Failed to load data</div>`;
            });
    }

    function goBack(bodyId) {
        let body = document.getElementById(bodyId);
        if(currentLayer == 1){
            document.getElementById('backToEditFilter').style.display = 'block';
            $("#layer-0").show();
        }
        if (currentLayer > 0) {
            let current = document.getElementById(`layer1-${currentLayer}`);
            if (current) {
                body.removeChild(current);
                currentLayer--;
                let prev = document.getElementById(`layer1-${currentLayer}`);
                if (prev) prev.style.display = 'block';
            }
        }
    }
</script>
@endif
@if($modal_no == 24)
<div class="modal-overlay" id="editEducation">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Education</h4>
            <span class="close-btn" id="closeEducation" onclick="closeEducationModal()" data-close="editEducation">&times;</span>
        </div>
        <div class="modal-body">
            <div class="form-group level-drp">
                
                @php
                    $degree_list = DB::table("degree")->get();
                @endphp

                <ul id="degreeList" style="display:none;">
                    @foreach($degree_list as $degree)
                    <li data-value="{{ $degree->id }}">{{ $degree->name }}</li>
                    
                    @endforeach
                </ul>
                <select class="js-example-basic-multiple addAll_removeAll_btn degreeList" data-list-id="degreeList" name="emr_ehr_data[]" multiple></select>
                <span id='reqsector_preferences' class='reqError text-danger valley'></span>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="closeEducationModal()" class="btn btn-default">Apply</button>
        </div>
    </div>
</div>
<script>
    // ✅ Unified state object (declared once globally)
    if (typeof selectedFilters === "undefined") {
        var selectedFilters = {
            nurse_type: [],
            employment_type: [],
            shiftType: [],
            language: []
        };
    }

    // Close modal
    function closeEducationModal() {
        $('#editEducation').hide();
    }

    // Apply button saves and closes
     $(document).on('change', '.degreeList', function () {
        let selectedValues = [];

        $(".degreeList").each(function () {
            let vals = $(this).val(); // array of selected IDs
            if (vals) {
                selectedValues = selectedValues.concat(vals);
            }
        });

        // Get existing filters from session
        var filter_data = sessionStorage.getItem("filters_data_saved");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Save combined language IDs
        selectedFilters.degree = selectedValues;
        filters_data.degree = selectedFilters.degree;

        sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));

        console.log("filters_data_saved (language)", filters_data);
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
            console.log("dropdown",$currentDropdown);
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
        var $clearButton_degree = $('.clear-button');

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

            $clearButton_degree.toggle($searchBox.val().length > 0);
        });

        $clearButton_degree.on('click', function() {
            $searchBox.val('');
            $searchBox.trigger('input');
        });
    });

    $('.js-example-basic-multiple').select2();

    // Dynamically add the clear button
    const clearButton_degree = $('<span class="clear-btn">✖</span>');
    $('.select2-container').append(clearButton_degree);

    // Handle the visibility of the clear button
    function toggleClearButton() {

        const selectedOptions = $('.js-example-basic-multiple').val();
        if (selectedOptions && selectedOptions.length > 0) {
            clearButton_degree.show();
        } else {
            clearButton_degree.hide();
        }
    }

    // Attach change event to select2
    $('.js-example-basic-multiple').on('change', toggleClearButton);

    // Clear button click event
    clearButton_degree.click(function() {

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
@endif
@if($modal_no == 23)
  <div class="modal-overlay" id="editRegistration" >
        <div class="modal-content">
        <div class="modal-header">
            <h4>Registration & Licences</h4>
            <span class="close-btn" id="closeregistration" onclick="removeregistration()" data-close="registrationModal">&times;</span>
        </div>
        <div class="modal-body">
            <div class="form-group level-drp">
                            
                            
                            
                            <ul id="licenses" style="display:none;">
                                
                                <li data-value="1">NDIS-registered provider</li>
                                <li data-value="2">Bills under Medicare / MBS (NP/Midwife)</li>
                                <li data-value="3">PBS Prescriber</li>
                                <li data-value="4">Immunisation Provider</li>
                                <li data-value="5">Uses radiation equipment</li>
                                
                            </ul>
                            <select class="js-example-basic-multiple addAll_removeAll_btn" data-list-id="licenses" name="licenses[]" multiple></select>
                            
                            
                        </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="removeregistration()" class="btn btn-default"> Apply </button>
        </div>
        </div>
  </div>

<script>
    // ✅ Unified state object (declared once globally)
    if (typeof selectedFilters === "undefined") {
        var selectedFilters = {
            nurse_type: [],
            employment_type: [],
            shiftType: [],
            language: []
        };
    }

    // ✅ Change handler for language dropdowns
    $(document).on('change', '.js-example-basic-multiple', function () {
        let selectedValues = [];

        $(".js-example-basic-multiple").each(function () {
            let vals = $(this).val(); // array of selected IDs
            if (vals) {
                selectedValues = selectedValues.concat(vals);
            }
        });

        // Get existing filters from session
        var filter_data = sessionStorage.getItem("filters_data_saved");
        var filters_data = filter_data ? JSON.parse(filter_data) : {};

        // Save combined language IDs
        selectedFilters.language = selectedValues;
        filters_data.language = selectedFilters.language;

        sessionStorage.setItem("filters_data_saved", JSON.stringify(filters_data));

        console.log("filters_data_saved (language)", filters_data);
    });

    // ✅ Apply button (still needed for triggering fetch + closing modal)
    function removeregistration() {

        // 1️⃣ Close Select2 dropdown if open
        $('.js-example-basic-multiple').select2('close');

        // 2️⃣ Remove Select2 wheel event (if you added namespace)
        $(document).off('wheel.select2fix');

        // 3️⃣ Destroy Select2 (VERY IMPORTANT for dynamic modals)
        $('.js-example-basic-multiple').each(function () {
            if ($(this).data('select2')) {
                $(this).select2('destroy');
            }
        });

        // 4️⃣ Clear modal content (prevents duplicate bindings)
        $('#editmodalContainer').empty();

        // 5️⃣ Restore body scroll (if it was blocked)
        $('body').css('overflow', 'auto');
        // Close modal
        $("#editRegistration").hide();
    }

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
            console.log("dropdown",$currentDropdown);
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
        var $clearButton_register = $('.clear-button');

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

            $clearButton_register.toggle($searchBox.val().length > 0);
        });

        $clearButton_register.on('click', function() {
            $searchBox.val('');
            $searchBox.trigger('input');
        });
    });

    $('.js-example-basic-multiple').select2();

    // Dynamically add the clear button
    const clearButton_register1 = $('<span class="clear-btn">✖</span>');
    $('.select2-container').append(clearButton_register1);

    // Handle the visibility of the clear button
    function toggleClearButton() {

        const selectedOptions = $('.js-example-basic-multiple').val();
        if (selectedOptions && selectedOptions.length > 0) {
            clearButton_register1.show();
        } else {
            clearButton_register1.hide();
        }
    }

    // Attach change event to select2
    $('.js-example-basic-multiple').on('change', toggleClearButton);

    // Clear button click event
    clearButton_register1.click(function() {

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

@endif
