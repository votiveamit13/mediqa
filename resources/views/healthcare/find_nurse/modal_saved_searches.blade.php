<div class="modal-overlay" id="save-search-modal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modal-title">Save Search</h3>
            <button type="button" class="close-modal btn-cancel"  >&times;</button>
        </div>

        <!-- Alert box -->
        <div class="modal-alert">
            <span class="alert-icon">!</span>
            <p>
                You've modified filters from the job criteria.<br>
                Saving will create a new custom search.<br>
                The original job tab will remain unchanged.
            </p>
        </div>

        <form id="add_saved_searches" method="POST" onsubmit="return add_saved_searches()">
            @csrf

            <!-- Search Name -->
            <div class="form-group">
                <label for="search-name">Search Name</label>
                <input type="text" id="search-name" name="search_name"
                       placeholder="ICU RN – Night Shift Only">
                       <span id='reqsearch-name'></span>
                <small class="form-tip">
                    Tip: Use a name that reflects your refinements (e.g., "ICU RN – Night Shift Only")
                </small>
                <span id="reqsearch-name" class="reqError text-danger"></span>
            </div>
            <!-- Actions -->
            <div class="modal-actions">
                <button type="button" class="btn-cancel">Cancel</button>
                <button type="submit" id="submitSavedSearches" class="btn-save">Save as New</button>
            </div>
        </form>
    </div>
</div>
<!-- Rename Modal -->
<div id="renameModal" class="modal-overlay" style="display:none;">
  <div class="modal-content">
    <h3>Rename Saved Search</h3>
    <input type="text" id="renameInput" class="form-control" placeholder="Enter new name">
    <div class="modal-actions">
      <button class="btn-cancel" id="renameCancel">Cancel</button>
      <button class="btn-save" id="renameSave1">Save</button>
    </div>
  </div>
</div>
<!-- DELETE CONFIRM MODAL -->
<div class="modal-overlay" id="delete-modal" style="display: none;">
    <div class="modal-content p-4">
        <p class="fs-4 p-0">This action cannot be undone.</p></br>
        <p class="fs-5 p-0">Are you sure?</p></br>
        <div class="d-flex align-items-center gap-2">
            <button class="modal-confirm" id="delete-confirm">Delete</button>
            <button class="modal-cancel" id="delete-cancel">Cancel</button>
        </div>
    </div>
</div>
<script>
    let selectedIds = [];
    $(document).on('change', '#selectAll', function() {
        const isChecked = $(this).is(':checked');
        $('.select-item').prop('checked', isChecked);
    });
    $(document).on('click', '.btn-delete', function() {
        // alert(12);
        selectedIds = [];
        $('.ss-checkbox:checked').each(function () {
            selectedIds.push($(this).closest('tr').data('name')); 
        });
        $('#delete-modal').fadeIn(200);
        $('#delete-confirm').attr("data-name","single-delete");
    });
    $('#delete-cancel').click(()=>$('#delete-modal').fadeOut(200));

  

    $(document).on('click', '#deleteSelected', function() {
        // alert(12);
        selectedIds = [];
        $('.ss-checkbox:checked').each(function () {
            selectedIds.push($(this).closest('tr').data('name')); 
        });
        console.log(selectedIds);
        if (selectedIds.length === 0) {
            alert("Please select at least one record to delete.");
            return;
        }
        $('#delete-modal').fadeIn(200).css('display', 'flex');
    });
    let deleteId = null;

    $('#delete-confirm').on('click', function () {
        $('#delete-modal').fadeOut(200);
        let btn_name = $(this).data("name");
            $.ajax({
                url: "{{ url('/healthcare-facilities/deleteMultipleSearches') }}",
                type: "POST",
                data: {
                    ids: selectedIds,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {

                    if (response.status === 'success') {

                        // ✅ Remove rows instantly (NO refresh)
                        $('.ss-checkbox:checked').each(function () {
                            $(this).closest('tr').fadeOut(300, function () {
                                $(this).remove();
                            });
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Saved searches deleted successfully'
                        });

                    } else {
                        alert("Error deleting records.");
                    }
                },
                error: function () {
                    alert("Something went wrong. Please try again.");
                }
            });        
    });
</script>
<script>
    let duplicateData = {};
    $(document).on('click', '.ss-duplicate', function () {

        const row = $(this).closest('tr');

        const id = row.data('id'); // ✅ FIXED
        const originalName = row.find('td:nth-child(2)').text().trim(); // name
        const filterSummary = row.find('td:nth-child(3)').html(); // ✅ FIXED

        const totalSearches = $('.ss-table tbody tr').length; // ✅ FIXED

        if (totalSearches >= 25) {
            Swal.fire({
                icon: 'warning',
                title: 'Limit Reached',
                text: "You’ve reached the limit of saved searches.",
                confirmButtonColor: '#c80014'
            });
            return;
        }

        // ✅ Store data
        duplicateData = {
            id: id,
            name: originalName,
            filterSummary: filterSummary
        };

        // Prefill modal
        $('#renameInput').val(originalName + " Copy");
        $('#renameModal').fadeIn(200).data('mode', 'duplicate');
    });

    $('#renameSave1').off('click').on('click', function () {

        const newName = $('#renameInput').val().trim();

        if (!newName) {
            alert("⚠️ Please enter a name to duplicate.");
            return;
        }

        const mode = $('#renameModal').data('mode');

        if (mode === 'duplicate') {

            $.ajax({
                type: "POST",
                url: "{{ url('/healthcare-facilities/duplicateSearch') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    searches_id: duplicateData.id,
                    name: newName
                },
                success: function (response) {

                    if (response.success) {

                        // ✅ Add new row instantly
                        addSearchDuplicate(response.new_id, newName);

                        $('#renameModal').fadeOut(200);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Search duplicated successfully!'
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Something went wrong."
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "Error duplicating search."
                    });
                }
            });
        }
    });

    $('#renameCancel').click(function () {
        $('#renameModal').fadeOut(200);
        duplicateData = {};
    });
    function addSearchDuplicate(id, name) {

        let d = new Date();
        let formattedDate = d.getFullYear() + '-' +
            String(d.getMonth() + 1).padStart(2, '0') + '-' +
            String(d.getDate()).padStart(2, '0');

        let row = `
        <tr class="ss-row" data-id="${id}">
            <td><input type="checkbox" class="ss-checkbox"></td>
            <td class="ss-name">${name}</td>
            <td class="ss-type">Read more</td>
            <td>-</td>
            <td>${formattedDate}</td>
            <td class="ss-actions">
                <button class="btn ss-run">Run</button>
                <button class="btn ss-primary"> Reset to Job Criteria </button>
                <button class="btn ss-edit">Edit</button>
                <button class="btn ss-duplicate">Duplicate</button>
                <button class="btn ss-delete">Delete</button>
            </td>
        </tr>
        `;

        $('.ss-table tbody').prepend(row); 
    }
</script>

<script>
    $(document).on('click', '.saved-add-search,#add-search-btn, .add-new', function(e) {
        e.preventDefault();

        const totalSearches = $('#savedSearchTable tbody tr').length;

        if (totalSearches >= 25) {
            Swal.fire({
                icon: 'warning',
                title: 'Limit Reached',
                text: "You’ve reached the limit of saved searches.",
                confirmButtonColor: '#c80014'
            });
            return;
        }

        $('#modal-title').text('Save Search');
        $('#save-search-modal').fadeIn(200);
    });

    $(document).on('click', '.btn-cancel', function() {
        $('.modal-overlay').fadeOut(200);
    });

    function add_saved_searches() {
        let name = $('#search-name').val().trim();
        if (!name) {
            $('#reqsearch-name').text('Search name is required');
            return false;
        }
        $('#reqsearch-name').text('');
        $.ajax({
            type: "POST",
            url: "{{ url('/healthcare-facilities/hFaddSavedSearches') }}",
            data: {
                search_name: name,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function () {
                $('#submitSavedSearches').prop('disabled', true).text('Processing...');
            },
            success: function (res) {
                console.log(res); // DEBUG
                $('#submitSavedSearches').prop('disabled', false).text('Save as New');

                     addSearchToUI(res.id, name);
                    $('#save-search-modal').fadeOut(200);
                    $('#add_saved_searches')[0].reset();

            
            },
            error: function (err) {

                $('#submitSavedSearches').prop('disabled', false).text('Save as New');

                if (err.responseJSON?.errors?.search_name) {
                    $('#reqsearch-name').text(err.responseJSON.errors.search_name[0]);
                }
            }
        });
        return false;
    }

    function addSearchToUI(id, name) {
        if ($('#search-tabs').length === 0) {
            console.error('search-tabs not found');
            return;
        }

        // ✅ Create tab
        let newTab = $(`
            <div class="saved-search-tab" data-id="${id}">
                ${name}
                <div class="unsaved-dot"></div>
            </div>
        `);

        // ✅ Safe append
        if ($('#search-tabs .add-new').length) {
            $('#search-tabs .add-new').before(newTab);
        } else {
            $('#search-tabs').append(newTab);
        }

        // ✅ Create row
        let row = `
        <tr class="ss-row" data-id="${id}">
            <td><input type="checkbox" class="ss-checkbox"></td>
            <td class="ss-name">${name}</td>
            <td class="ss-type">Read more</td>
            <td><span class="ss-match">0</span></td>
            <td>${new Date().toISOString().split('T')[0]}</td>
            <td>-</td>
            <td class="ss-actions">
                <button class="btn ss-run">Run</button>
                <button class="btn ss-edit">Edit</button>
                <button class="btn ss-duplicate">Duplicate</button>
                <button class="btn ss-delete">Delete</button>
            </td>
        </tr>
        `;

        // ✅ Ensure table exists
        if ($('#savedSearchTable tbody').length) {
            $('#savedSearchTable tbody').append(row);
        } else {
            console.error('Table tbody not found');
        }
        $('.ss-table .text-muted').remove();
    }
</script>

