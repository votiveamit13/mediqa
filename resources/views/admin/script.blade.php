    <script>
        $(document).ready(function() {

            // Add an additional search box to the dropdown
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
        });
    </script>
    <script>
        $(document).ready(function() {

            // Add an additional search box and extra buttons to the dropdown
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

        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for each select element with class .js-example-basic-multiple
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
            var nurse_array = [];
            // Show corresponding job lists when an option is selected in the first select
            $('.js-example-basic-multiple[data-list-id="type-of-nurse"]').on('change', function() {
                let selectedValues = $(this).val();
                //alert("hello");
                var nurse_len = $("#type-of-nurse li").length;
                console.log("nurse_len", nurse_len);

                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

                console.log("selectedValues", selectedValues);
                //$('.result--show .form-group').addClass('d-none');

                for (var i = 1; i <= nurse_len; i++) {
                    var nurse_result_val = $(".nursing_result-" + i).val();
                    //alert(nurse_result_val);
                    if (selectedValues.includes(nurse_result_val)) {

                        $('#nursing_level-' + i).removeClass('d-none');
                    } else {
                        $('#nursing_level-' + i).addClass('d-none');
                    }
                }

                // }
            });

            $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').on('change', function() {
                let selectedValues = $(this).val();
                //alert("hello");
                var nurse_len = $("#type-of-nurse li").length;
                console.log("nurse_len", nurse_len);

                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
                if (selectedValues.includes("179")) {
                    $('.np_submenu').removeClass('d-none');
                    console.log("selectedValues", selectedValues);
                } else {
                    $('.np_submenu').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(null).trigger('change');
                }
            });

            $('.js-example-basic-multiple[data-list-id="specialties"]').on('change', function() {
                let selectedValues = $(this).val();
                //alert("hello");
                var speciality_len = $("#specialties li").length;
                console.log("speciality_len", speciality_len);

                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

                console.log("selectedValues", selectedValues);
                //$('.result--show .form-group').addClass('d-none');

                for (var k = 1; k <= speciality_len; k++) {
                    var speciality_result_val = $(".speciality_result-" + k).val();
                    //alert(speciality_result_val);
                    if (selectedValues.includes(speciality_result_val)) {

                        $('#specility_level-' + k).removeClass('d-none');
                        //$(".sub_speciality_value").val(k);

                    } else {
                        $('#specility_level-' + k).addClass('d-none');
                        $('.js-example-basic-multiple[data-list-id="speciality_entry-' + k + '"]').select2().val(null).trigger('change');
                    }
                }

                if (selectedValues.includes("1") == false) {
                    $('.surgical_row').addClass('d-none');
                    $('.surgical_row_data').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
                }
                if (selectedValues.includes("2") == false) {

                    $('.surgicalobs_row').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
                }

                if (selectedValues.includes("3") == false) {

                    $('.surgicalpad_row_data').addClass('d-none');
                    $('.surgical_rowp_data').addClass('d-none');
                    $('.neonatal_row').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgicalobs_row_data"]').select2().val(null).trigger('change');
                }


            });

            var sub_specialty_data_val = $(".sub_speciality_value").val();
            console.log("specialty_data_len", sub_specialty_data_val);

            $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').on('change', function() {
                let selectedValues = $(this).val();

                var speciality_entry = $("#speciality_entry-1 li").length;
                console.log("speciality_entry", speciality_entry);
                // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
                $(".surgical_row_data").insertAfter("#specility_level-1");
                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

                console.log("selectedValues", selectedValues.includes("96"));
                //$('.result--show .form-group').addClass('d-none');

                if (selectedValues.includes("96")) {
                    $('.surgical_row_data').removeClass('d-none');
                } else {
                    $('.surgical_row_data').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
                }

                if (selectedValues.includes("96") == false) {
                    $('.surgical_row').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
                }



                // for(var k = 1;k<=speciality_entry;k++){
                //     var speciality_result_val = $(".speciality_result-"+k).val();
                //     //alert(speciality_result_val);
                //     if(selectedValues.includes(speciality_result_val)){

                //         $('#specility_level-'+k).removeClass('d-none');

                //     }else{
                //         $('#specility_level-'+k).addClass('d-none');
                //     }
                // }
            });
            $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').on('change', function() {
                let selectedValues = $(this).val();
                //alert("hello");
                var speciality_entry = $("#surgical_row_box li").length;
                console.log("speciality_entry", speciality_entry);
                // $(".surgical_row").wrapAll("<div class='col-md-12 row surgical_row_data'>");
                $(".specialty_sub_boxes").insertAfter(".surgical_row_data");
                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

                console.log("selectedValues", selectedValues);
                //$('.result--show .form-group').addClass('d-none');

                // if(selectedValues.includes("97")){
                //     $('.surgical_row').removeClass('d-none');
                // }else{
                //     $('.surgical_row').addClass('d-none');
                // }



                for (var k = 1; k <= speciality_entry; k++) {
                    var speciality_result_val = $(".speciality_surgical_result-" + k).val();

                    if (selectedValues.includes(speciality_result_val)) {

                        $('.surgical_row-' + k).removeClass('d-none');

                    } else {
                        $('.surgical_row-' + k).addClass('d-none');
                        $('.js-example-basic-multiple[data-list-id="surgical_operative_care-' + k + '"]').select2().val(null).trigger('change');
                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').on('change', function() {
                let selectedValues = $(this).val();
                //alert("hello");
                var speciality_entry = $("#speciality_entry-3 li").length;
                console.log("speciality_entry", speciality_entry);
                $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
                $(".paediatric_surgical_div").insertAfter("#specility_level-3");


                //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
                $(".neonatal_row").insertAfter("#specility_level-3");

                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

                console.log("selectedValues", selectedValues);
                //$('.result--show .form-group').addClass('d-none');

                if (selectedValues.includes('250')) {
                    $('.neonatal_row').removeClass('d-none');
                } else {
                    $('.neonatal_row').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(null).trigger('change');
                }

                if (selectedValues.includes('285')) {
                    $('.surgicalpad_row_data').removeClass('d-none');
                } else {
                    $('.surgicalpad_row_data').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(null).trigger('change');
                }

                if (selectedValues.includes("285") == false) {
                    $('.surgical_rowp_data').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(null).trigger('change');
                }

                // for(var k = 1;k<=speciality_entry;k++){
                //     var speciality_result_val = $(".speciality_result-"+k).val();
                //     //alert(speciality_result_val);
                //     if(selectedValues.includes(speciality_result_val)){

                //         $('#specility_level-'+k).removeClass('d-none');

                //     }else{
                //         $('#specility_level-'+k).addClass('d-none');
                //     }
                // }
            });

            $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').on('change', function() {
                let selectedValues = $(this).val();
                //alert("hello");
                var speciality_entry = $("#surgical_rowpad_box li").length;
                console.log("speciality_entry", speciality_entry);
                // $(".surgical_rowp").wrapAll("<div class='col-md-12 row surgical_rowp_data'>");
                $(".surgical_rowp_data").insertAfter(".surgicalpad_row_data");


                //     $(".neonatal_row").wrapAll("<div class='col-md-12 row neonatal_row_data'>");
                //     $(".neonatal_row_data").insertAfter("#specility_level-3");

                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

                console.log("selectedValues", selectedValues);
                //$('.result--show .form-group').addClass('d-none');



                for (var k = 1; k <= speciality_entry; k++) {
                    var speciality_result_val = $(".surgical_rowp_result-" + k).val();
                    //alert(speciality_result_val);
                    if (selectedValues.includes(speciality_result_val)) {

                        $('.surgical_rowp-' + k).removeClass('d-none');

                    } else {
                        $('.surgical_rowp-' + k).addClass('d-none');
                        $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-' + k + '"]').select2().val(null).trigger('change');
                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').on('change', function() {
                let selectedValues = $(this).val();
                //alert("hello");
                var speciality_entry = $("#speciality_entry-1 li").length;
                console.log("speciality_entry", speciality_entry);
                // $(".surgicalobs_row").wrapAll("<div class='col-md-12 row surgicalobs_row_data'>");
                $(".surgicalobs_row").insertAfter("#specility_level-2");

                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));

                console.log("selectedValues", selectedValues);
                //$('.result--show .form-group').addClass('d-none');

                if (selectedValues.includes("233")) {
                    $('.surgicalobs_row').removeClass('d-none');
                } else {
                    $('.surgicalobs_row').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(null).trigger('change');
                }

                // for(var k = 1;k<=speciality_entry;k++){
                //     var speciality_result_val = $(".speciality_result-"+k).val();
                //     //alert(speciality_result_val);
                //     if(selectedValues.includes(speciality_result_val)){

                //         $('#specility_level-'+k).removeClass('d-none');

                //     }else{
                //         $('#specility_level-'+k).addClass('d-none');
                //     }
                // }
            });



            var nurse_type_list = $('#nurse_type').select2("data");

            for (var x = 0; x < nurse_type_list.length; x++) {
                $(".nursing_" + nurse_type_list[x].id).removeClass('d-none');
            }

            if ($(".ntype").val() != "") {
                var nurse_type = JSON.parse($(".ntype").val());
                $('#nurse_type').select2().val(nurse_type).trigger('change');
            }

            if ($(".nursing_result_one").val() != "") {
                var entry_level = JSON.parse($(".nursing_result_one").val());
                $('.js-example-basic-multiple[data-list-id="nursing_entry-1"]').select2().val(entry_level).trigger('change');
            }

            if ($(".nursing_result_two").val() != "") {
                var registered_nurses = JSON.parse($(".nursing_result_two").val());
                $('.js-example-basic-multiple[data-list-id="nursing_entry-2"]').select2().val(registered_nurses).trigger('change');
            }

            if ($(".nursing_result_three").val() != "") {
                var advanced_practioner = JSON.parse($(".nursing_result_three").val());
                $('.js-example-basic-multiple[data-list-id="nursing_entry-3"]').select2().val(advanced_practioner).trigger('change');
            }

            if ($(".np_result").val() != "") {
                var nurse_prac = JSON.parse($(".np_result").val());
                $('.js-example-basic-multiple[data-list-id="nurse_practitioner_menu"]').select2().val(nurse_prac).trigger('change');
            }

            if ($(".specialties_result").val() != "") {
                var specialties = JSON.parse($(".specialties_result").val());
                $('.js-example-basic-multiple[data-list-id="specialties"]').select2().val(specialties).trigger('change');
            }

            if ($(".adults_result").val() != "") {
                var adults = JSON.parse($(".adults_result").val());
                $('.js-example-basic-multiple[data-list-id="speciality_entry-1"]').select2().val(adults).trigger('change');
            }

            if ($(".maternity_result").val() != "") {
                var maternity = JSON.parse($(".maternity_result").val());
                $('.js-example-basic-multiple[data-list-id="speciality_entry-2"]').select2().val(maternity).trigger('change');
            }

            if ($(".padneonatal_result").val() != "") {
                var paediatrics_neonatal = JSON.parse($(".padneonatal_result").val());
                $('.js-example-basic-multiple[data-list-id="speciality_entry-3"]').select2().val(paediatrics_neonatal).trigger('change');
            }

            if ($(".community_result").val() != "") {
                var community = JSON.parse($(".community_result").val());
                $('.js-example-basic-multiple[data-list-id="speciality_entry-4"]').select2().val(community).trigger('change');
            }

            if ($(".surgical_preoperative_result").val() != "") {
                var surgical_preoperative = JSON.parse($(".surgical_preoperative_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_row_box"]').select2().val(surgical_preoperative).trigger('change');
            }

            if ($(".operatingroom_result").val() != "") {
                var operating_room = JSON.parse($(".operatingroom_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_operative_care-1"]').select2().val(operating_room).trigger('change');
            }

            if ($(".operatingscout_result").val() != "") {
                var operating_room_scout = JSON.parse($(".operatingscout_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_operative_care-2"]').select2().val(operating_room_scout).trigger('change');
            }

            if ($(".operatingscrub_result").val() != "") {
                var operating_room_scrub = JSON.parse($(".operatingscrub_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_operative_care-3"]').select2().val(operating_room_scrub).trigger('change');
            }

            if ($(".surgical_ob_result").val() != "") {
                var surgical_obstrics_gynacology = JSON.parse($(".surgical_ob_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_obs_care"]').select2().val(surgical_obstrics_gynacology).trigger('change');
            }

            if ($(".neonatal_care_result").val() != "") {
                var neonatal_care = JSON.parse($(".neonatal_care_result").val());
                $('.js-example-basic-multiple[data-list-id="neonatal_care"]').select2().val(neonatal_care).trigger('change');
            }

            if ($(".paedia_surgical_result").val() != "") {
                var paedia_surgical_preoperative = JSON.parse($(".paedia_surgical_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_rowpad_box"]').select2().val(paedia_surgical_preoperative).trigger('change');
            }

            if ($(".pad_op_room_result").val() != "") {
                var pad_op_room = JSON.parse($(".pad_op_room_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-1"]').select2().val(pad_op_room).trigger('change');
            }

            if ($(".pad_qr_scout_result").val() != "") {
                var pad_qr_scout = JSON.parse($(".pad_qr_scout_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-2"]').select2().val(pad_qr_scout).trigger('change');
            }

            if ($(".pad_qr_scrub_result").val() != "") {
                var pad_qr_scrub = JSON.parse($(".pad_qr_scrub_result").val());
                $('.js-example-basic-multiple[data-list-id="surgical_operative_carep-3"]').select2().val(pad_qr_scrub).trigger('change');
            }

            if ($(".nurse_degree_one").val() != "") {
                var nurse_degree = JSON.parse($(".nurse_degree_one").val());
                $('.js-example-basic-multiple[data-list-id="ndegree"]').select2().val(nurse_degree).trigger('change');
            }

            if ($(".prof_cert_new").val() != "") {
                var prof_cert_new = JSON.parse($(".prof_cert_new").val());
                $('.js-example-basic-multiple[data-list-id="profess_cert"]').select2().val(prof_cert_new).trigger('change');
            }

            if ($(".pro_cert_acls").val() != "") {
                var pro_cert_acls = JSON.parse($(".pro_cert_acls").val());
                // console.log("pro_cert_acls",pro_cert_acls);
                $('.js-example-basic-multiple[data-list-id="acls_data"]').select2().val(pro_cert_acls).trigger('change');
            }

            if ($(".pro_cert_bls").val() != "") {
                var pro_cert_bls = JSON.parse($(".pro_cert_bls").val());
                // console.log("pro_cert_bls",pro_cert_bls);
                $('.js-example-basic-multiple[data-list-id="bls_data"]').select2().val(pro_cert_bls).trigger('change');
            }

            if ($(".pro_cert_cpr").val() != "") {
                var pro_cert_cpr = JSON.parse($(".pro_cert_cpr").val());
                // console.log("pro_cert_bls",pro_cert_cpr);
                $('.js-example-basic-multiple[data-list-id="cpr_data"]').select2().val(pro_cert_cpr).trigger('change');
            }

            if ($(".pro_cert_nrp").val() != "") {
                var pro_cert_nrp = JSON.parse($(".pro_cert_nrp").val());
                console.log("pro_cert_bls", pro_cert_nrp);
                $('.js-example-basic-multiple[data-list-id="nrp_data"]').select2().val(pro_cert_nrp).trigger('change');
            }

            if ($(".pro_cert_pals").val() != "") {
                var pro_cert_pals = JSON.parse($(".pro_cert_pals").val());
                console.log("pro_cert_bls", pro_cert_pals);
                $('.js-example-basic-multiple[data-list-id="pls_data"]').select2().val(pro_cert_pals).trigger('change');
            }

            if ($(".pro_cert_rn").val() != "") {
                var pro_cert_rn = JSON.parse($(".pro_cert_rn").val());
                console.log("pro_cert_bls", pro_cert_rn);
                $('.js-example-basic-multiple[data-list-id="rn_data"]').select2().val(pro_cert_rn).trigger('change');
            }

            if ($(".pro_cert_np").val() != "") {
                var pro_cert_np = JSON.parse($(".pro_cert_np").val());
                console.log("pro_cert_bls", pro_cert_np);
                $('.js-example-basic-multiple[data-list-id="np_data"]').select2().val(pro_cert_np).trigger('change');
            }

            if ($(".pro_cert_cna").val() != "") {
                var pro_cert_cna = JSON.parse($(".pro_cert_cna").val());
                console.log("pro_cert_bls", pro_cert_cna);
                $('.js-example-basic-multiple[data-list-id="cn_data"]').select2().val(pro_cert_cna).trigger('change');
            }

            if ($(".pro_cert_lpn").val() != "") {
                var pro_cert_lpn = JSON.parse($(".pro_cert_lpn").val());
                console.log("pro_cert_bls", pro_cert_lpn);
                $('.js-example-basic-multiple[data-list-id="lpn_data"]').select2().val(pro_cert_lpn).trigger('change');
            }

            if ($(".pro_cert_crna").val() != "") {
                var pro_cert_crna = JSON.parse($(".pro_cert_crna").val());
                console.log("pro_cert_bls", pro_cert_crna);
                $('.js-example-basic-multiple[data-list-id="crn_data"]').select2().val(pro_cert_crna).trigger('change');
            }

            if ($(".pro_cert_cnm").val() != "") {
                var pro_cert_cnm = JSON.parse($(".pro_cert_cnm").val());
                console.log("pro_cert_bls", pro_cert_cnm);
                $('.js-example-basic-multiple[data-list-id="cnm_data"]').select2().val(pro_cert_cnm).trigger('change');
            }

            if ($(".pro_cert_ons").val() != "") {
                var pro_cert_ons = JSON.parse($(".pro_cert_ons").val());
                console.log("pro_cert_bls", pro_cert_ons);
                $('.js-example-basic-multiple[data-list-id="ons_data"]').select2().val(pro_cert_ons).trigger('change');
            }

            if ($(".pro_cert_msw").val() != "") {
                var pro_cert_msw = JSON.parse($(".pro_cert_msw").val());
                console.log("pro_cert_bls", pro_cert_msw);
                $('.js-example-basic-multiple[data-list-id="msw_data"]').select2().val(pro_cert_msw).trigger('change');
            }

            if ($(".pro_cert_ain").val() != "") {
                var pro_cert_ain = JSON.parse($(".pro_cert_ain").val());
                console.log("pro_cert_bls", pro_cert_ain);
                $('.js-example-basic-multiple[data-list-id="ain_data"]').select2().val(pro_cert_ain).trigger('change');
            }

            if ($(".pro_cert_rpn").val() != "") {
                var pro_cert_rpn = JSON.parse($(".pro_cert_rpn").val());
                console.log("pro_cert_bls", pro_cert_rpn);
                $('.js-example-basic-multiple[data-list-id="rpn_data"]').select2().val(pro_cert_rpn).trigger('change');
            }

            if ($(".pro_cert_nl").val() != "") {
                var pro_cert_nl = JSON.parse($(".pro_cert_nl").val());
                console.log("pro_cert_bls", pro_cert_nl);
                $('.js-example-basic-multiple[data-list-id="nlc_data"]').select2().val(pro_cert_nl).trigger('change');
            }

            if ($(".professional_as").val() != "") {
                var professional_as = JSON.parse($(".professional_as").val());
                console.log("professional_as", professional_as);
                $('.js-example-basic-multiple[data-list-id="des_profession_association"]').select2().val(professional_as).trigger('change');
            }



        });
    </script>



    {{-- country,state, city onchange  --}}
    <script>
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



        /*------------------------------------------

        --------------------------------------------

        State Dropdown Change Event 

        --------------------------------------------

        --------------------------------------------*/

        $('#stateI').on('change', function() {

            var idState = this.value;

            $("#cityI").html('');

            $.ajax({

                url: "{{url('fetch-ville')}}",

                type: "POST",

                data: {

                    province_id: idState,

                    _token: '{{csrf_token()}}'

                },

                dataType: 'json',

                success: function(res) {

                    $('#cityI').html('<option value=""> Select City </option>');

                    $.each(res.ville, function(key, value) {

                        $("#cityI").append('<option value="' + value

                            .id + '">' + value.name + '</option>');

                    });

                }

            });

        });
    </script>
    {{-- phone number,emrgencu contact --}}
    <script>
        $(document).ready(function() {
            $('#contact').keypress(function(e) {

                var charCode = (e.which) ? e.which : event.keyCode

                if (String.fromCharCode(charCode).match(/[^0-9]/g))

                    return false;

            });

            $('#emrg_contact').keypress(function(e) {

                var charCode = (e.which) ? e.which : event.keyCode

                if (String.fromCharCode(charCode).match(/[^0-9]/g))

                    return false;

            });
            // Function to initialize intl-tel-input and set up event listeners
            function initializeIntlTelInput(inputSelector, countyCodeInputSelector, countryNameInputSelector, countryIsoInputSelector) {
                const input = document.querySelector(inputSelector);
                const countyCodeInput = document.querySelector(countyCodeInputSelector);
                const countryNameInput = document.querySelector(countryNameInputSelector);
                const countryIsoInput = document.querySelector(countryIsoInputSelector);

                const iti = window.intlTelInput(input, {
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                    initialCountry: "AU", // Automatically detect the user's country
                    hiddenInput: "full_number",
                    // localizedCountries: { 'de': 'Deutschland' },
                    // nationalMode: false,
                    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                    // placeholderNumberType: "MOBILE",
                    preferredCountries: ['AU'],
                    geoIpLookup: function(callback) {
                        fetch('https://ipinfo.io/json')
                            .then(response => response.json())
                            .then(data => callback(data.country || 'us')) // Fallback to 'us' if detection fails
                            .catch(() => callback('us')); // Fallback to 'us' if there's an error
                    }
                });

                // Function to update hidden fields with selected country data
                function updateCountryData() {
                    const countryData = iti.getSelectedCountryData();
                    countyCodeInput.value = countryData.dialCode;
                    countryNameInput.value = countryData.name;
                    countryIsoInput.value = countryData.iso2; // ISO code of the country
                }

                // Ensure country data is set on initialization
                updateCountryData();

                // Event listener for country change
                input.addEventListener("countrychange", function() {
                    updateCountryData();
                });

                // Validate input on blur
                input.addEventListener('blur', function() {
                    const errorSpan = document.querySelector(`${inputSelector}_error`);
                    if (iti.isValidNumber()) {
                        errorSpan.textContent = "";
                    } else {
                        // errorSpan.textContent = "Invalid phone number.";
                    }
                });

                return iti;
            }

            // Initialize intl-tel-input for Mobile No
            initializeIntlTelInput(
                "#emrg_contact",
                "#country_code_mobile",
                "#country_name_mobile",
                "#country_iso_mobile"
            );

            // Initialize intl-tel-input for Phone Number
            initializeIntlTelInput(
                "#contact",
                "#country_code_phone",
                "#country_name_phone",
                "#country_iso_phone"
            );
        });
    </script>
    {{-- Image preview --}}
    <script>

    </script>

    {{-- for add Nurse script --}}
    <script>
        $(document).ready(function() {
            $('#professs_form').on('submit', function(event) {
                event.preventDefault();
                var targetTab = $('#professs_form').data('target');
                // Function to enable the next tab

                var isValid = true;
                if ($('[name="states[]"]').val() == '') {
                    document.getElementById("reqnurseTypeId").innerHTML = "* Please select one or more Type of nurse";
                    isValid = false;
                }

                if ($('[name="specialties[]"]').val() == '') {
                    document.getElementById("specialties_error").innerHTML = "* Please select one or more specialties.";
                    isValid = false;
                }
                // if ($('[name="degree[]"]').val() == '') {
                //   document.getElementById("reqdegree").innerHTML = "* Please select degree.";
                //   isValid = false;
                // }
                if ($('[name="bio"]').val() == '') {
                    document.getElementById("bio_error").innerHTML = "* Please enter the bio.";
                    isValid = false;
                }

                if ($('[name="employee_status"]').val() == '') {
                    document.getElementById("status_error").innerHTML = "* Please select the employee status.";
                    isValid = false;
                }

                if ($('[name="temporary_status"]').val() == '') {
                    document.getElementById("temp_status_error").innerHTML = "* Please select the employee status.";
                    isValid = false;
                }

                if ($(".declare_information").prop('checked') == false) {
                    document.getElementById("diclare_error").innerHTML = "* Please check this checkbox";
                    isValid = false;
                }

                if (isValid == true) {
                    $.ajax({
                        url: "{{ route('admin.add_nurse_post_2') }}",
                        type: "POST",
                        // data: formData,
                        data: new FormData($('#professs_form')[0]),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                        },
                        success: function(res) {
                            console.log(res.type);

                            if (res.status == '2') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(function() {
                                    let currentTab = 'tab-3';
                                    let targetTab = 'tab-4';
                                    let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;

                                    // Disable the current tab and save it in local storage
                                    $('.nav-link[href="#' + currentTab + '"]').addClass('disabled').attr('aria-disabled', 'true').off('click');
                                    let disabledTabs = JSON.parse(localStorage.getItem('disabledTabs')) || [];
                                    if (!disabledTabs.includes(currentTab)) {
                                        disabledTabs.push(currentTab);
                                        localStorage.setItem('disabledTabs', JSON.stringify(disabledTabs));
                                    }

                                    // Redirect to the target tab
                                    window.location.href = newUrl;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message,
                                });
                            }
                            // Show the target tab
                        },
                        error: function(error) {
                            // if(targetTab ==  '#navpill-2'){

                        }
                    });

                }
            });
        });

        $(document).ready(function() {
            // Initially deactivate all tabs except the first one
            // $('.nav-pills .nav-link').not('.active').addClass('disabled');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }

            $('#uploadButton').on('click', function() {
                $('#profile_image').click();
            });

            $('#profile_image').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImage').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('.next-step-1').on('click', function() {

                $(".valley").html("");
                var targetTab = $(this).data('target');
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                // Get the value of the selected radio button
                var selectedGender = $('input[name="gender"]:checked').val();
                var contact = $('#contact').val();
                var profile_image = $('#profile_image')[0].files[0];
                //  alert(profile_image);
                var profile_image = $('#profile_image').val();
                var dob = $('#dob').val();
                var per_website = $('#per_website').val();
                var countryI = $('#countryI').val();
                var stateI = $('#stateI').val();
                var city = $('#city').val();
                var zip_code = $('#zip_code').val();
                var home_address = $('#home_address').val();
                var emrg_contact = $('#emrg_contact').val();
                var emrg_email = $('#emrg_email').val();
                var passwordI = document.getElementById("passwordI").value;
                var confirm_passwordI = document.getElementById("confirm_passwordI").value;


                let hasErrors = true;


                if (passwordI == "") {

                    document.getElementById("reqTxtpasswordI").innerHTML = "*  Please enter the PasswordI.";

                    hasErrors = false;

                } else {
                    $('#reqTxtpasswordI').text('');
                }



                var pattern = /^.*(?=.{7,12})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&!-_]).*$/;

                if (!pattern.test(passwordI)) {

                    document.getElementById("reqTxtpasswordI").innerHTML = "Password length should be 7 Characters with atleast 1 number, lower, upper & special(@#$%&!-_&) characters.";

                    hasErrors = false;

                } else {
                    $('#reqTxtpasswordI').text('');
                }


                if (confirm_passwordI == "") {

                    document.getElementById("reqTxtconfirm_passwordI").innerHTML = "* Please Enter the Confirm password.";

                    hasErrors = false;

                } else {
                    $('#reqTxtconfirm_passwordI').text('');
                }

                if (passwordI != confirm_passwordI) {

                    document.getElementById("reqTxtconfirm_passwordI").innerHTML = "Password and Confirm password do not match.";

                    hasErrors = false;

                } else {
                    $('#reqTxtconfirm_passwordI').text('');
                }


                // Create a new FormData object
                var formData = new FormData();

                // if(targetTab ==  '#navpill-2'){
                // Append form fields to the FormData object
                formData.append('first_name', $('#first_name').val());
                formData.append('last_name', $('#last_name').val());
                formData.append('email', $('#email').val());
                formData.append('gender', $('input[name="gender"]:checked').val());
                formData.append('contact', $('#contact').val());
                formData.append('country_code_phone', $('#country_code_phone').val());
                formData.append('country_iso_phone', $('#country_iso_phone').val());

                // Append the file
                var profile_image = $('#profile_image')[0].files[0];

                if (profile_image) {
                    formData.append('profile_image', profile_image);
                }

                formData.append('dob', $('#dob').val());
                formData.append('per_website', $('#per_website').val());
                formData.append('country', countryI);
                formData.append('state', stateI);
                formData.append('city', $('#city').val());
                formData.append('zip_code', $('#zip_code').val());
                formData.append('home_address', $('#home_address').val());
                formData.append('emrg_contact', $('#emrg_contact').val());
                formData.append('emrg_email', $('#emrg_email').val());
                formData.append('country_code_mobile', $('#country_code_mobile').val());
                formData.append('country_iso_mobile', $('#country_iso_mobile').val());
                formData.append('tab', 'tab1');
                formData.append('nationality', $('#nationality').val());
                formData.append('passwordI', passwordI);

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_1') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                let currentTab = 'tab-1';
                                let targetTab = 'tab-2';
                                //let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;
                                let newUrl = window.location.protocol + "//" + window.location.host + "/admin/setting_availablity?tab=" + targetTab;
                            
                                sessionStorage.setItem('email', $('#email').val());

                                // Disable the current tab and save it in local storage
                                $('.nav-link[href="#' + currentTab + '"]').addClass('disabled').attr('aria-disabled', 'true').off('click');
                                let disabledTabs = JSON.parse(localStorage.getItem('disabledTabs')) || [];
                                if (!disabledTabs.includes(currentTab)) {
                                    disabledTabs.push(currentTab);
                                    localStorage.setItem('disabledTabs', JSON.stringify(disabledTabs));
                                }

                                // Redirect to the target tab
                                window.location.href = newUrl;

                            });


                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {
                        // if(targetTab ==  '#navpill-2'){
                        if (error.responseJSON.errors) {
                            if (error.responseJSON.errors.first_name) {
                                $('#first_name_error').text(error.responseJSON.errors.first_name[0]);
                            } else {
                                $('#first_name_error').text('');
                            }

                            if (error.responseJSON.errors.last_name) {
                                $('#last_name_error').text(error.responseJSON.errors.last_name[0]);

                            } else {
                                $('#last_name_error').text('');
                            }

                            if (error.responseJSON.errors.contact) {
                                $('#contact_error').text(error.responseJSON.errors.contact[0]);

                            } else {
                                $('#contact_error').text('');
                            }

                            if (error.responseJSON.errors.email) {
                                $('#email_error').text(error.responseJSON.errors.email[0]);

                            } else {
                                $('#email_error').text('');
                            }

                            if (error.responseJSON.errors.gender) {
                                $('#genderErr').text(error.responseJSON.errors.gender[0]);

                            } else {
                                $('#genderErr').text('');
                            }

                            if (error.responseJSON.errors.dob) {
                                $('#date_error').text(error.responseJSON.errors.dob[0]);

                            } else {
                                $('#date_error').text('');
                            }

                            if (error.responseJSON.errors.per_website) {
                                $('#per_website_error').text(error.responseJSON.errors.per_website[0]);

                            } else {
                                $('#per_website_error').text('');
                            }

                            if (error.responseJSON.errors.country) {
                                $('#country_error').text(error.responseJSON.errors.country[0]);

                            } else {
                                $('#country_error').text('');
                            }

                            if (error.responseJSON.errors.state) {
                                $('#state_error').text(error.responseJSON.errors.state[0]);

                            } else {
                                $('#state_error').text('');
                            }

                            if (error.responseJSON.errors.city) {
                                $('#city_error').text(error.responseJSON.errors.city[0]);

                            } else {
                                $('#city_error').text('');
                            }

                            if (error.responseJSON.errors.zip_code) {
                                $('#zip_code_error').text(error.responseJSON.errors.zip_code[0]);

                            } else {
                                $('#zip_code_error').text('');
                            }

                            if (error.responseJSON.errors.home_address) {
                                $('#home_address_error').text(error.responseJSON.errors.home_address[0]);

                            } else {
                                $('#home_address_error').text('');
                            }

                            if (error.responseJSON.errors.emrg_contact) {
                                $('#emrg_contact_error').text(error.responseJSON.errors.emrg_contact[0]);

                            } else {
                                $('#emrg_contact_error').text('');
                            }

                            if (error.responseJSON.errors.emrg_email) {
                                $('#emrg_email_error').text(error.responseJSON.errors.emrg_email[0]);
                            } else {
                                $('#emrg_email_error').text('');
                            }


                            if (error.responseJSON.errors.home_address) {
                                $('#home_address_error').text(error.responseJSON.errors.zip_code[0]);
                            } else {
                                $('#home_address_error').text('');
                            }

                            if (error.responseJSON.errors.profile_image) {
                                $('#profile_image_error').text(error.responseJSON.errors.profile_image[0]);

                            } else {
                                $('#profile_image_error').text('');
                            }

                        }
                    }
                });

                // if (!hasErrors) {
                //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
                // }

            });
        });
    </script>

    <script>
        // thired form         
        $(document).ready(function() {
            $('#educert_form').on('submit', function(event) {
                event.preventDefault();

                var isValid = true;


                var institution = $('#institution').val();
                var most_relevant = $('#most_relevant').val();

                var graduation_start_date = $('#graduation_start_date').val();

                var graduation_end_date = $('#graduation_end_date').val();

                var upload_degree = $('#upload_degree')[0].files[0];


                if ($(".declare_information_edu").prop('checked') == false) {
                    document.getElementById("reqdeclare_information1").innerHTML = "* Please check this checkbox";
                    isValid = false;
                }

                if ($('[name="ndegree[]"]').val() == '') {
                    document.getElementById("ndegree_error").innerHTML = "* Please select degree.";
                    isValid = false;
                }

                if ($('[name="institution"]').val() == '') {
                    document.getElementById("institution_error").innerHTML = "* Please enter the institutions.";
                    isValid = false;
                }

                if ($('[name="graduation_start_date"]').val() == '') {
                    document.getElementById("gra_start_date_error").innerHTML = "* Please enter the graduation start date.";
                    isValid = false;
                }

                if ($('[name="professional_certification[]"]').val() == '') {
                    document.getElementById("profess_cert_error").innerHTML = "* Please select professional certificate";
                    isValid = false;
                }

                if ($(".procertdiv").hasClass("d-none") == false) {
                    if ($('[name="acls_data[]"]').val() == '') {
                        document.getElementById("reqaclsvalid").innerHTML = "* Please select ACLS (Advanced Cardiovascular Life Support)";
                        isValid = false;
                    }
                }
                if ($('[name="upload_degree"]').val() == '') {
                    document.getElementById("upload_degree_error").innerHTML = "* Please Upload the file.";
                    isValid = false;
                }

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

                $(".acls_upload_certification").each(function() {

                    console.log("acls_upload_certification", $(".acls_licence_img-" + k).length);
                    if ($(".acls_licence_img-" + k).length == 0) {
                        if ($(".acls_upload_certification-" + k).length > 0) {
                            if ($(".acls_upload_certification-" + k).val() == '') {
                                document.getElementById("reqaclsuploadvalid-" + k).innerHTML = "* Please add the license image";
                                isValid = false;
                            }
                        }
                    }
                    k++;
                });


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

                if (isValid == true) {
                    $('#educert_form').find('.text-danger').hide();
                    var targetTab = '#navpill-6';

                    function enableNextTab(targetTab) {
                        $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
                    }

                    $.ajax({
                        url: "{{ route('admin.add_nurse_post_3') }}",
                        type: "POST",
                        data: new FormData($('#educert_form')[0]),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                        },
                        success: function(res) {
                            console.log(res.type);

                            if (res.status == '2') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(function() {
                                    let currentTab = 'tab-4';
                                    let targetTab = 'tab-6';
                                    let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;

                                    // Disable the current tab and save it in local storage
                                    $('.nav-link[href="#' + currentTab + '"]').addClass('disabled').attr('aria-disabled', 'true').off('click');
                                    let disabledTabs = JSON.parse(localStorage.getItem('disabledTabs')) || [];
                                    if (!disabledTabs.includes(currentTab)) {
                                        disabledTabs.push(currentTab);
                                        localStorage.setItem('disabledTabs', JSON.stringify(disabledTabs));
                                    }

                                    // Redirect to the target tab
                                    window.location.href = newUrl;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message,
                                });
                            }
                            // Show the target tab
                        },
                        error: function(error) {
                            // if(targetTab == '#navpill-2'){
                            if (error.responseJSON.errors) {}
                        }
                    });

                }



            })
        });
    </script>

    <script>
        // thired form        
        $('.next-step-5').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');
            // Initially deactivate all tabs except the first one
            // $('.nav-pills .nav-link').not('.active').addClass('disabled');

            // Function to enable the next tab
            function enableNextTab(targetTab) {
                $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            }

            // Create a new FormData object
            var formData = new FormData();

            var selectElement = $('select[id="assistent_level"]');
            var assistent_level = selectElement.val();

            var previous_employer_name = $('#previous_employer_name').val();

            var selectElement1 = $('select[data-list-id="positions_held"]');
            var positions_held = selectElement1.val();

            var start_date = $('#start_date').val();

            var end_date = $('#end_date').val();

            var present_box = $('#present_box').val();

            var job_responeblities = $('#job_responeblities').val();

            var achievements = $('#achievements').val();

            var selectElement2 = $('select[data-list-id="skills_compantancies"]');
            var skills_compantancies = selectElement2.val();


            let hasErrors = false;

            formData.append('assistent_level', JSON.stringify(assistent_level));
            formData.append('previous_employer_name', previous_employer_name);
            formData.append('start_date', start_date);
            formData.append('end_date', end_date);
            formData.append('present_box', present_box);
            formData.append('job_responeblities', job_responeblities);
            formData.append('positions_held', JSON.stringify(positions_held));
            formData.append('achievements', achievements);
            formData.append('skills_compantancies', JSON.stringify(skills_compantancies));

            formData.append('tab', 'tab4');

            $.ajax({
                url: "{{ route('admin.add_nurse_post_4') }}",
                type: "POST",
                data: formData,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                },
                success: function(res) {
                    console.log(res.type);

                    if (res.status == '2') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            $('a[href="' + targetTab + '"]').tab('show');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                    // Show the target tab
                },
                error: function(error) {
                    // if(targetTab ==  '#navpill-2'){
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.previous_employer_name) {
                            $('#previous_employer_name_error').text(error.responseJSON.errors.previous_employer_name[0]);
                        } else {
                            $('#previous_employer_name_error').text('');
                        }

                        if (error.responseJSON.errors.positions_held) {
                            $('#positions_held_error').text(error.responseJSON.errors.positions_held[0]);
                        } else {
                            $('#positions_held_error').text('');
                        }

                        if (error.responseJSON.errors.start_date) {
                            $('#start_date_error').text(error.responseJSON.errors.start_date[0]);
                        } else {
                            $('#start_date_error').text('');
                        }

                        if (error.responseJSON.errors.end_date) {
                            $('#end_date_error').text(error.responseJSON.errors.end_date[0]);
                        } else {
                            $('#end_date_error').text('');
                        }

                        if (error.responseJSON.errors.job_responeblities) {
                            $('#job_responeblities_error').text(error.responseJSON.errors.job_responeblities[0]);
                        } else {
                            $('#job_responeblities_error').text('');
                        }


                        if (error.responseJSON.errors.achievements) {
                            $('#achievements_error').text(error.responseJSON.errors.achievements[0]);
                        } else {
                            $('#achievements_error').text('');
                        }

                        if (error.responseJSON.errors.skills_compantancies) {
                            $('#skills_compantancies_error').text(error.responseJSON.errors.skills_compantancies[0]);
                        } else {
                            $('#skills_compantancies_error').text('');
                        }

                        if (error.responseJSON.errors.present_box) {
                            $('#present_box_error').text(error.responseJSON.errors.present_box[0]);
                        } else {
                            $('#present_box_error').text('');
                        }

                        // }                        
                    }
                }
            });

            // if (!hasErrors) {
            //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
            // }

        });
    </script>

    <script>
        //four form        
        $('.next-step-6').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');
            // Initially deactivate all tabs except the first one
            // $('.nav-pills .nav-link').not('.active').addClass('disabled');

            // Function to enable the next tab
            function enableNextTab(targetTab) {
                $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            }

            // Create a new FormData object
            var formData = new FormData();

            var tra_start_date = $('#tra_start_date').val();
            var tra_end_date = $('#tra_end_date').val();

            var selectElement1 = $('select[id="mand_continue_education"]');
            var mand_continue_education = selectElement1.val();

            var institution1 = $('#institution1').val();

            let hasErrors = false;

            formData.append('tra_start_date', tra_start_date);
            formData.append('tra_end_date', tra_end_date);
            formData.append('mand_continue_education', mand_continue_education);
            formData.append('institution1', institution1);
            formData.append('tab', 'tab5');



            // if (!hasErrors) {
            //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
            // }

        });

        $('#man_tra_form').on('submit', function(event) {
            event.preventDefault();
            var targetTab = $('#man_tra_form').data('target');
            // Function to enable the next tab

            var isValid = true;

            if ($('[name="mandatory_courses[]"]').val() == '') {
                document.getElementById("reqmantra").innerHTML = "*Please Select training";
                isValid = false;
            }
            if ($(".mandatory_tr_div_1").hasClass("d-none") == false) {
                if ($('[name="well_self_care_data[]"]').val() == '') {
                    document.getElementById("reqwellself").innerHTML = "* Please Select Wellness And Self-Care";
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
                if ($('[name="tech_innvo_health[]"]').val() == '') {
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
                    if ($(".lmid_spec-0-" + i).val() == '') {
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
                if ($(".clinic_skill-0-" + i).length > 0) {
                    if ($(".clinic_skill-0-" + i).val() == '') {
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
                $.ajax({
                    url: "{{ route('admin.add_nurse_post_5') }}",
                    type: "POST",
                    data: new FormData($('#man_tra_form')[0]),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                window.location.href = "{{ route('admin.add_nurse', ['tab' => 'navpill-5.1']) }}";
                                // let currentTab = 'tab-6';
                                // let targetTab = 'tab-7';
                                // let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;
                                // // Disable the current tab and save it in local storage
                                // $('.nav-link[href="#' + currentTab + '"]').addClass('disabled').attr('aria-disabled', 'true').off('click');
                                // let disabledTabs = JSON.parse(localStorage.getItem('disabledTabs')) || [];
                                // if (!disabledTabs.includes(currentTab)) {
                                //     disabledTabs.push(currentTab);
                                //     localStorage.setItem('disabledTabs', JSON.stringify(disabledTabs));
                                // }
                                // // Redirect to the target tab
                                // window.location.href = newUrl;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {}
                });

            }

        });
    </script>

    <script>
        //six form
        $('.next-step-7').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission
            var targetTab = $(this).data('target');
            // Initially deactivate all tabs except the first one
            // $('.nav-pills .nav-link').not('.active').addClass('disabled');
            // Function to enable the next tab
            function enableNextTab(targetTab) {
                $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            }
            // Create a new FormData object
            var formData = new FormData();
            var selectElement1 = $('select[data-list-id="vaccination_record"]');
            var vaccination_record = selectElement1.val();

            //other vaccine start
            const vaccinationInputs = document.querySelectorAll('.vaccination-name');
            vaccinationInputs.forEach((input) => {
                formData.append('vaccination_name[]', input.value);
            });

            const imm_status = document.querySelectorAll('.imm_status');
            imm_status.forEach((input) => {
                formData.append('immunization_status[]', input.value);
            });

            const ev_type = document.querySelectorAll('.ev_type');
            ev_type.forEach((input) => {
                formData.append('evidence_type[]', input.value);
            });
            const fileInputs = document.querySelectorAll('.ev-file');
            fileInputs.forEach((input) => {
                // Append each selected file to FormData
                if (input.files.length > 0) {
                    Array.from(input.files).forEach((file) => {
                        formData.append('evidence_file[]', file);
                    });
                }
            });

            //other vaccine end
            const statusSelects = document.querySelectorAll('.immunization-status');
            statusSelects.forEach((select) => {
                const name = select.getAttribute('name'); // Get the dynamic name
                const value = select.value; // Get the selected value
                formData.append(name, value); // Append both the name and value to FormData
            });

            const cDoseSelects = document.querySelectorAll('.covid-dose');
            cDoseSelects.forEach((select) => {
                const name = select.getAttribute('name'); // Get the dynamic name
                const value = select.value; // Get the selected value
                formData.append(name, value); // Append both the name and value to FormData
            });

            const evidenceTypes = document.querySelectorAll('.evidence-types:checked'); // Only checked ones
            evidenceTypes.forEach((radio) => {
                const name = radio.getAttribute('name'); // Get the dynamic name
                const value = radio.value; // Get the selected value
                formData.append(name, value); // Append name-value pair to FormData
            });

            const evidenceReq = document.querySelectorAll('.evidence-required:checked'); // Only checked ones
            evidenceReq.forEach((radio) => {
                const name = radio.getAttribute('name'); // Get the dynamic name
                const value = radio.value; // Get the selected value
                formData.append(name, value); // Append name-value pair to FormData
            });

            const fileInputsss = document.querySelectorAll('.evidancefile'); // Target all file inputs with the class
            fileInputsss.forEach((input) => {
                const name = input.getAttribute('name'); // Get the dynamic name (e.g., evidancefile1[])
                if (input.files.length > 0) {
                    Array.from(input.files).forEach((file) => {
                        formData.append(name, file); // Append each file under its respective dynamic name
                    });
                }
            });



            let hasErrors = false;

            formData.append('vaccination_record', JSON.stringify(vaccination_record));
            formData.append('tab', 'tab6');
            console.log(formData);

            $.ajax({
                url: "{{ route('admin.addNurseVaccination') }}",
                type: "POST",
                data: formData,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                },
                success: function(res) {
                    console.log(res.type);

                    if (res.status == '2') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            //$('a[href="' + targetTab + '"]').tab('show');
                            let fullPath = window.location.pathname;
                            let pathParts = fullPath.split("/").filter(part => part !== "");
                            let uriSegment = pathParts[0];
                            console.log("path",uriSegment);
                            var targetTab = 'tab-9';
                            var newUrl = window.location.protocol + "//" + window.location.host +'/'+uriSegment+  '/updateWorkClreance?tab=' + targetTab;
                            window.location.href = newUrl;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                    // Show the target tab
                },
                error: function(error) {
                    // if(targetTab ==  '#navpill-2'){
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.vaccination_record) {
                            $('#vaccination_error').text(error.responseJSON.errors.vaccination_record[0]);
                        } else {
                            $('#vaccination_error').text('');
                        }

                        if (error.responseJSON.errors.immunization_status) {
                            $('#immunization_status_error').text(error.responseJSON.errors.immunization_status[0]);
                        } else {
                            $('#immunization_status_error').text('');
                        }


                    }
                }
            });

            // if (!hasErrors) {
            //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
            // }

        });
    </script>

    <script>
        //seven form        
        $('.eligibility_work').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;
            $(".valley").html("");

            var residencyId = $("#residencyId").val();
            var image_support_documentI = $("#image_support_documentI").val();
            var visa_subclass_numberI = $("#visa_subclass_numberI").val();
            var passport_numberI = $("#passport_numberI").val();
            var passportcountryI = $("#passportcountryI").val();
            var visa_grant_numberI = $("#visa_grant_numberI").val();
            var expiry_dataI = $("#expiry_dataI").val();

            if (residencyId.trim() === "") {
                $("#residency_error").html("* Please Select the Residency.");
                returnValue = false;
            }

            if (residencyId.trim() !== 'Citizen') {
                if (visa_subclass_numberI.trim() === "") {
                    $("#visa_subclass_error").html("* Please Enter the Subclass Number.");
                    returnValue = false;
                }
                if (passport_numberI.trim() === "") {
                    $("#passport_number_error").html("* Please Enter the Passport Number.");
                    returnValue = false;
                }
                if (passportcountryI.trim() === "") {
                    $("#passport_country_error").html("* Please Select the Passport Country.");
                    returnValue = false;
                }
                if (visa_grant_numberI.trim() === "") {
                    $("#visa_grant_error").html("* Please Enter the Passport Number.");
                    returnValue = false;
                }
                if (residencyId.trim() === 'Visa Holder') {
                    if (expiry_dataI.trim() === "") {
                        $("#expiry_date_error").html("* Please Select the Expiry Date.");
                        returnValue = false;
                    }
                }
            }

            if (image_support_documentI.trim() === "") {
                $("#image_support_error").html("* Please Upload the Support Document.");
                returnValue = false;
            }

            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();

                // Append the file
                var image_support_documentI = $('#image_support_documentI')[0].files[0];

                formData.append('residencyId', residencyId);
                formData.append('image_support_documentI', image_support_documentI);
                formData.append('visa_subclass_numberI', visa_subclass_numberI);
                formData.append('passport_numberI', passport_numberI);
                formData.append('passportcountryI', passportcountryI);
                formData.append('visa_grant_numberI', visa_grant_numberI);
                formData.append('expiry_dataI', expiry_dataI);
                formData.append('type', 'eligibility_work');

                formData.append('tab', 'tab7');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_7') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });

        $('.children_check').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;
            $(".valley").html("");

            var clearance_numberI = $("#clearance_numberI").val();
            var clearancestateI = $("#clearancestateI").val();
            var clearance_expiry_dataI = $("#clearance_expiry_dataI").val();
            if (clearance_numberI.trim() == "") {

                document.getElementById("reqTxtclearance_numberI").innerHTML = "* Please Enter the Clearance Number.";

                returnValue = false;

            }

            if (clearancestateI.trim() == "") {

                document.getElementById("reqTxtclearancestateI").innerHTML = "* Please Select  the state.";

                returnValue = false;

            }
            if (clearance_expiry_dataI.trim() == "") {

                document.getElementById("reqTxtclearance_expiry_dataI").innerHTML = "* Please Select the Expiry Date.";

                returnValue = false;


            }


            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();

                formData.append('clearance_numberI', clearance_numberI);
                formData.append('clearance_expiry_dataI', clearance_expiry_dataI);
                formData.append('clearancestateI', clearancestateI);
                formData.append('type', 'children_check');

                formData.append('tab', 'tab7');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_7') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });

        $('.police_check').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;

            $(".valley").html("");

            var date_acquiredI = $("#date_acquiredI").val();
            var image_support_document_policeI = $("#image_support_document_policeI").val();
            var checkbox = $("#confirmationCheckboxPoliceCheck");


            if (date_acquiredI.trim() == "") {

                document.getElementById("reqTxtdate_acquiredI").innerHTML = "* Please Select  the date of  Acquired.";

                returnValue = false;

            }

            if (image_support_document_policeI.trim() == "") {

                document.getElementById("reqTxtimage_support_documentI").innerHTML = "* Please Upload the Police Check File.";

                returnValue = false;

            }
            if (!checkbox.is(':checked')) {
                alert('Please confirm your action.');
                document.getElementById("reqTxtconfirmationCheckboxPoliceCheckI").innerHTML = "Required field: Confirmation required.";
                returnValue = false;
            }


            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();
                var image_support_document_policeI = $('#image_support_document_policeI')[0].files[0];
                formData.append('date_acquiredI', date_acquiredI);
                formData.append('confirmationCheckboxPoliceCheck', confirmationCheckboxPoliceCheck);
                formData.append('image_support_document_policeI', image_support_document_policeI);
                formData.append('type', 'police_check');

                formData.append('tab', 'tab7');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_7') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });
    </script>



    <script>
        // Eight form
        $('.next-step-9').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;

            $(".valley").html("");

            var selectElement1 = $('select[data-list-id="des_profession_association"]');
            var des_profession_association = selectElement1.val();
            var membership_numbers = $("#membership_numbers").val();
            var membership_status = $("#membership_status").val();


            if ($('[name="des_profession_association[]"]').val() == "") {

                document.getElementById("des_profession_error").innerHTML = "* Please select professional association.";

                returnValue = false;

            }

            if (membership_numbers.trim() == "") {

                document.getElementById("membership_numbers_error").innerHTML = "* Please enter memebership numbers.";

                returnValue = false;

            }
            if (membership_status.trim() == "") {

                document.getElementById("membership_status_error").innerHTML = "* Please select membership status.";

                returnValue = false;

            }


            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();
                formData.append('des_profession_association', JSON.stringify(des_profession_association));
                formData.append('membership_numbers', membership_numbers);
                formData.append('membership_status', membership_status);

                formData.append('tab', 'tab8');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_8') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });
    </script>

    <script>
        // nine form
        $('.next-step-10').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;

            $(".valley").html("");

            var selectElement1 = $('select[id="reference_relationship"]');
            var reference_relationship = selectElement1.val();
            var interview_availablity = $("#interview_availablity").val();
            var reference_name = $("#reference_name").val();
            var reference_email = $("#reference_email").val();
            var reference_contactI = $("#reference_contactI").val();


            if (reference_relationship == "") {

                document.getElementById("reqprofessionalrelationship").innerHTML = "* Please select the reference relationship";

                returnValue = false;

            }

            if (interview_availablity.trim() == "") {

                document.getElementById("reqinterviewdate").innerHTML = "* Please enter the interview availability";

                returnValue = false;

            }
            if (reference_name.trim() == "") {

                document.getElementById("reqprofessionalnames").innerHTML = "* Please enter the references name";

                returnValue = false;

            }
            if (reference_contactI.trim() == "") {

                document.getElementById("reqTxtreferencecontactI").innerHTML = "* Please enter the reference contact";

                returnValue = false;

            }
            if (reference_email.trim() == "") {

                document.getElementById("reqprofessionalemail").innerHTML = "* Please enter the references email";

                returnValue = false;

            }


            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();
                formData.append('reference_relationship', reference_relationship);
                formData.append('interview_availablity', interview_availablity);
                formData.append('reference_name', reference_name);
                formData.append('reference_email', reference_email);
                formData.append('reference_contactI', reference_contactI);
                formData.append('reference_countryiso', $("#reference_countryiso").val());
                formData.append('reference_countryCode', $("#reference_countryCode").val());

                formData.append('tab', 'tab9');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_9') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });
    </script>

    <script>
        // ten form
        $('.next-step-11').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;

            $(".valley").html("");

            var selectElement1 = $('select[id="preferred_work_schedule"]');
            var preferred_work_schedule = selectElement1.val();

            var selectElement2 = $('select[id="countryworkprefer"]');
            var countryworkprefer = selectElement2.val();

            var stateworkprefer = $('[name="state"]').val();
            // var stateworkprefer = selectElement3.val();

            var specific_facilities = $("#specific_facilities").val();

            var selectElement4 = $('select[id="work_environment"]');
            var work_environment = selectElement4.val();

            var selectElement5 = $('select[id="shift_preferences"]');
            var shift_preferences = selectElement5.val();


            if (preferred_work_schedule == "") {

                document.getElementById("reqpreferecschedule").innerHTML = "* Please select prefered work schedule";

                returnValue = false;

            }

            if (countryworkprefer == "") {

                document.getElementById("reqprecountry").innerHTML = "* Please select the country";

                returnValue = false;

            }

            if (stateworkprefer == "") {

                document.getElementById("reqprestateI").innerHTML = "* Please select the state";

                returnValue = false;

            }

            if (specific_facilities.trim() == "") {

                document.getElementById("reqspecificfacilities").innerHTML = "* Please enter the specific facilities";

                returnValue = false;

            }
            if (work_environment == "") {

                document.getElementById("reqworkenvironement").innerHTML = "* Please select the work environment";

                returnValue = false;

            }
            if (shift_preferences == "") {

                document.getElementById("reqshiftpreferences").innerHTML = "* Please select the shift preferences";

                returnValue = false;

            }



            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();
                formData.append('shift_preferences', shift_preferences);
                formData.append('work_environment', work_environment);
                formData.append('specific_facilities', specific_facilities);
                formData.append('stateworkprefer', stateworkprefer);
                formData.append('countryworkprefer', countryworkprefer);
                formData.append('preferred_work_schedule', preferred_work_schedule);

                formData.append('tab', 'tab10');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_10') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });
    </script>

    <script>
        // ELENVEN form
        $('.next-step-12').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;

            $(".valley").html("");

            var selectElement1 = $('select[data-list-id="des_job_role"]');
            var des_job_role = selectElement1.val();

            var selectElement2 = $('select[data-list-id="benefit_prefer"]');
            var benefit_prefer = selectElement2.val();

            var salary_expectation = $('[name="salary_expectation"]').val();
            // var stateworkprefer = selectElement3.val();

            if (des_job_role == "") {

                document.getElementById("reqjobroles").innerHTML = "* Please select desired job role";

                returnValue = false;

            }



            if (benefit_prefer == "") {

                document.getElementById("reqbenefitsprefer").innerHTML = "* Please select benefits preferences ";

                returnValue = false;

            }

            if ($('[name="salary_expectation"]').val() == '') {
                document.getElementById("reqsalaryexp").innerHTML = "* Please enter salary expectation";
                returnValue = false;
            }




            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();
                formData.append('salary_expectation', salary_expectation);
                formData.append('benefit_prefer', JSON.stringify(benefit_prefer));
                formData.append('des_job_role', JSON.stringify(des_job_role));

                formData.append('tab', 'tab11');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_11') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                $('a[href="' + targetTab + '"]').tab('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });
    </script>

    <script>
        // THIRTEEN  form
        $('.next-step-14').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            // var targetTab = $(this).data('target');

            // // Function to enable the next tab
            // function enableNextTab(targetTab) {
            //     $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            // }
            var returnValue = true;

            $(".valley").html("");

            var selectElement1 = $('select[id="language-picker-select"]');
            var language_picker_select = selectElement1.val();

            var hobbies_interests = $('[name="hobbies_interests"]').val();

            var volunteer_experience = $('[name="volunteer_experience"]').val();
            // var stateworkprefer = selectElement3.val();


            if ($('[name="additional_info_language"]').val() == '') {
                document.getElementById("reqinfolanguage").innerHTML = "* Please select language";
                returnValue = false;
            }

            if ($('[name="volunteer_experience"]').val() == '') {
                document.getElementById("reqvolexp").innerHTML = "* Please enter Volunteer Experience";
                returnValue = false;
            }

            if ($('[name="hobbies_interests"]').val() == '') {
                document.getElementById("reqhobbiesint").innerHTML = "* Please enter Hobbies and Interests";
                returnValue = false;
            }




            if (!returnValue) {
                // $('.submit-btn-120').prop('disabled', false);
                // $('.submit-btn-1').hide();
                // $('.resetpassword').show();
                return false;
            }

            if (returnValue) {

                // Create a new FormData object
                var formData = new FormData();
                formData.append('language_picker_select', language_picker_select);
                formData.append('hobbies_interests', hobbies_interests);
                formData.append('volunteer_experience', volunteer_experience);

                formData.append('tab', 'tab13');

                $.ajax({
                    url: "{{ route('admin.add_nurse_post_13') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                window.location.href = '{{ route("admin.inprogess-nurse-nurse-list")}}';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });

            }
        });
    </script>

    <script>
        // THIRTEEN  form
        $('.next-step-2').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            var targetTab = $(this).data('target');

            // // Function to enable the next tab
            function enableNextTab(targetTab) {
                $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
            }
            var returnValue = true;

            $(".valley").html("");

            var visibleToAgencies = $('[name="agencies"]').val();

            var individuals = $('[name="individuals"]').val();

            var profile_status = $('[name="profile_status"]').val();

            var available_date = $('[name="available_date"]').val();
            // var stateworkprefer = selectElement3.val();

            // Create a new FormData object
            var formData = new FormData();
            formData.append('visibleToAgencies', visibleToAgencies);
            formData.append('individuals', individuals);
            formData.append('profile_status', profile_status);
            formData.append('available_date', available_date);

            formData.append('tab', 'tab14');

            $.ajax({
                url: "{{ route('admin.add_nurse_post_14') }}",
                type: "POST",
                data: formData,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                },
                success: function(res) {
                    console.log(res.type);

                    if (res.status == '2') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            let currentTab = 'tab-2';
                            let targetTab = 'tab-3';
                            //let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;

                            let newUrl = window.location.protocol + "//" + window.location.host + "/admin/setting_availablity?tab=" + targetTab;
                            
                            sessionStorage.setItem('email', $('#email').val());
                            // Disable the current tab and save it in local storage
                            $('.nav-link[href="#' + currentTab + '"]').addClass('disabled').attr('aria-disabled', 'true').off('click');
                            let disabledTabs = JSON.parse(localStorage.getItem('disabledTabs')) || [];
                            if (!disabledTabs.includes(currentTab)) {
                                disabledTabs.push(currentTab);
                                localStorage.setItem('disabledTabs', JSON.stringify(disabledTabs));
                            }

                            // Redirect to the target tab
                            window.location.href = newUrl;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                    // Show the target tab
                },
                error: function(error) {

                }
            });


        });
    </script>

    <script>
        // THIRTEEN  form
        $(document).ready(function() {
            $('#reference_form1').on('submit', function(event) {
                event.preventDefault();
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

                if (isValid == true) {
                    $('#reference_form').find('.text-danger').hide();


                    $.ajax({
                        url: "{{ route('admin.add_nurse_post_15') }}",
                        type: "POST",
                        data: new FormData($('#reference_form1')[0]),
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                        },
                        success: function(res) {
                            console.log(res.type);
                            if (res.status == '2') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(function() {
                                    let currentTab = 'navpill-5.1';
                                    let targetTab = 'navpill-7';
                                    let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;


                                    // Disable the current tab and save it in local storage
                                    $('.nav-link[href="#' + currentTab + '"]').addClass('disabled').attr('aria-disabled', 'true').off('click');
                                    let disabledTabs = JSON.parse(localStorage.getItem('disabledTabs')) || [];
                                    if (!disabledTabs.includes(currentTab)) {
                                        disabledTabs.push(currentTab);
                                        localStorage.setItem('disabledTabs', JSON.stringify(disabledTabs));
                                    }

                                    // Redirect to the target tab
                                    window.location.href = newUrl;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message,
                                });
                            }
                            // Show the target tab
                        },
                        error: function(error) {}
                    });
                }

            })
        });
    </script>



    <script>
        $('.js-example-basic-multiple[data-list-id="profess_cert"]').on('change', function() {
            let selectedValues = $(this).val();
            //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
            if (selectedValues.includes("6")) {
                $('.procertdiv').removeClass('d-none');
                $('.license_number_acls').removeClass('d-none');
            } else {
                $('.procertdiv').addClass('d-none');
                $('.license_number_acls').addClass('d-none');
                $('.acls_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="acls_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("7")) {
                $('.procertdivone').removeClass('d-none');
                $('.license_number_bls').removeClass('d-none');
            } else {
                $('.procertdivone').addClass('d-none');
                $('.license_number_bls').addClass('d-none');
                $('.bls_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="bls_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("8")) {
                $('.procertdivtwo').removeClass('d-none');
                $('.license_number_cpr').removeClass('d-none');
            } else {
                $('.procertdivtwo').addClass('d-none');
                $('.license_number_cpr').addClass('d-none');
                $('.cpr_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="cpr_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("9")) {
                $('.procertdivthree').removeClass('d-none');
                $('.license_number_nrp').removeClass('d-none');

            } else {
                $('.procertdivthree').addClass('d-none');
                $('.license_number_nrp').addClass('d-none');
                $('.nrp_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="nrp_data"]').select2().val(null).trigger('change');

            }
            if (selectedValues.includes("10")) {
                $('.procertdivfour').removeClass('d-none');
                $('.license_number_pals').removeClass('d-none');


            } else {
                $('.procertdivfour').addClass('d-none');
                $('.license_number_pals').addClass('d-none');
                $('.pls_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="pls_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("11")) {
                $('.procertdivfive').removeClass('d-none');
                $('.license_number_rn').removeClass('d-none');

            } else {
                $('.procertdivfive').addClass('d-none');
                $('.license_number_rn').addClass('d-none');
                $('.rn_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="rn_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("12")) {
                $('.procertdivsix').removeClass('d-none');
                $('.license_number_cn').removeClass('d-none');
            } else {

                $('.procertdivsix').addClass('d-none');
                $('.license_number_cn').addClass('d-none');
                $('.cna_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="cn_data"]').select2().val(null).trigger('change');
            }

            if (selectedValues.includes("13")) {
                $('.procertdivseven').removeClass('d-none');
                $('.license_number_lpn').removeClass('d-none');

            } else {
                $('.procertdivseven').addClass('d-none');
                $('.license_number_lpn').addClass('d-none');
                $('.lpn_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="lpn_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("14")) {
                $('.procertdiveight').removeClass('d-none');
                $('.license_number_crn').removeClass('d-none');
            } else {
                $('.procertdiveight').addClass('d-none');
                $('.license_number_crn').addClass('d-none');
                $('.crn_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="crn_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("15")) {
                $('.procertdivnine').removeClass('d-none');
                $('.license_number_cnm').removeClass('d-none');
            } else {
                $('.procertdivnine').addClass('d-none');
                $('.license_number_cnm').addClass('d-none');
                $('.cnm_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="cnm_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("16")) {
                $('.procertdivten').removeClass('d-none');
                $('.license_number_ons').removeClass('d-none');
            } else {
                $('.procertdivten').addClass('d-none');
                $('.license_number_ons').addClass('d-none');
                $('.ons_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="ons_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("17")) {
                $('.procertdiveleven').removeClass('d-none');
                $('.license_number_msw').removeClass('d-none');
            } else {
                $('.procertdiveleven').addClass('d-none');
                $('.license_number_msw').addClass('d-none');
                $('.msw_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="msw_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("18")) {
                $('.procertdivtwelfth').removeClass('d-none');
                $('.license_number_np').removeClass('d-none');
            } else {
                $('.procertdivtwelfth').addClass('d-none');
                $('.license_number_np').addClass('d-none');
                $('.np_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="np_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("19")) {
                $('.procertdivthirteen').removeClass('d-none');
                $('.license_number_ain').removeClass('d-none');
            } else {
                $('.procertdivthirteen').addClass('d-none');
                $('.license_number_ain').addClass('d-none');
                $('.ain_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="ain_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("20")) {
                $('.procertdivfourteen').removeClass('d-none');
                $('.license_number_rpn').removeClass('d-none');
            } else {
                $('.procertdivfourteen').addClass('d-none');
                $('.license_number_rpn').addClass('d-none');
                $('.rpn_certification_div').addClass('d-none');
                $('.js-example-basic-multiple[data-list-id="rpn_data"]').select2().val(null).trigger('change');
            }
            if (selectedValues.includes("21")) {
                $('.procertdivfiveteen').removeClass('d-none');
                $('.license_number_nlc').removeClass('d-none');
            } else {
                $('.procertdivfiveteen').addClass('d-none');
                $('.license_number_nlc').addClass('d-none');

                $('.js-example-basic-multiple[data-list-id="nlc_data"]').select2().val(null).trigger('change');
            }
        });
        $('.js-example-basic-multiple[data-list-id="acls_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var acls_certification_array = [];
            $('.acls_certification_div').removeClass('d-none');
            $(".acls_certification_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".acls_" + res_one).remove();
                }
                acls_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                if (acls_certification_array.includes(selectedValues[i]) == false) {

                    var user_id = "{{ $sessid }}";
                    var img_text = "acls_imgs";
                    // $(".acls_certification_div").append('<div class="acls_'+res_one+' cert_div_'+selected_text+'"><h6 class="cert_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="aclsnamearr[]" class="bls_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control acls_license_number acls_license_number-'+i+'" type="text" name="acls_license_number[]"><span id="reqaclslicencevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control aclsexpiry aclsexpiry-'+i+'" type="date" name="acls_expiry[]"><span id="reqaclsexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control acls_upload_certification acls_imgs_'+res_one+' acls_upload_certification-'+i+'" type="file" name="acls_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqaclsuploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="acls_imgs'+res_one+'"></div></div></div></div>');
                    $(".acls_certification_div").append(`
                <div class="acls_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="aclsnamearr[]" class="bls_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input class="form-control acls_license_number acls_license_number-${i}" type="text" name="acls_license_number[]">
                            <span id="reqaclslicencevalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input class="form-control aclsexpiry aclsexpiry-${i}" type="date" name="acls_expiry[]">
                            <span id="reqaclsexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control acls_upload_certification acls_imgs_${res_one} acls_upload_certification-${i}" 
                                type="file" 
                                name="acls_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <span id="reqaclsuploadvalid-${i}" class="reqError text-danger valley"></span>
                            <div class="acls_imgs${res_one}"></div>
                        </div>
                    </div>
                </div>
            `);

                }
            }


        });
        $('.js-example-basic-multiple[data-list-id="bls_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var bls_certification_array = [];
            $('.bls_certification_div').removeClass('d-none');
            $(".bls_certification_div h6").each(function() {
                var text = $(this).text();
                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one2", res_one);

                    $(".bls_" + res_one).remove();
                }
                bls_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (bls_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "bls_imgs";

                    // $(".bls_certification_div").append('<div class="bls_'+res_one+' cert_div_'+selected_text+'"><h6>'+selectedValues[i]+'</h6><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control bls_license_number bls_license_number-'+i+'" type="text" name="bls_license_number[]"><span id="reqblslicencevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control blsexpiry blsexpiry-'+i+'" type="date" name="bls_expiry[]"><span id="reqblsexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control bls_upload_certification degree_transcript bls_imgs_'+res_one+' bls_upload_certification-'+i+'" type="file" name="bls_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><div class="bls_imgs'+res_one+'"></div><span id="reqblsuploadvalid-'+i+'" class="reqError text-danger valley"></span></div></div></div>');
                    $(".bls_certification_div").append(`
                <div class="bls_${res_one} cert_div_${selected_text}">
                    <h6>${selectedValues[i]}</h6>
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control bls_license_number bls_license_number-${i}" 
                                type="text" 
                                name="bls_license_number[]">
                            <span 
                                id="reqblslicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control blsexpiry blsexpiry-${i}" 
                                type="date" 
                                name="bls_expiry[]">
                            <span 
                                id="reqblsexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control bls_upload_certification degree_transcript bls_imgs_${res_one} bls_upload_certification-${i}" 
                                type="file" 
                                name="bls_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="bls_imgs${res_one}"></div>
                            <span 
                                id="reqblsuploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);

                }
            }
        });
        $('.js-example-basic-multiple[data-list-id="cpr_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var cpr_certification_array = [];
            $('.cpr_certification_div').removeClass('d-none');
            $(".cpr_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".cpr_" + res_one).remove();
                }

                cpr_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (cpr_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "cpr_imgs";

                    // $(".cpr_certification_div").append('<div class="cpr_'+res_one+' cert_div_'+selected_text+'"><h6 class="cert_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="cprnamearr[]" class="cpr_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control cpr_license_number cpr_license_number-'+i+'" type="text" name="cpr_license_number[]"><span id="reqcprlicencevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control cprexpiry cprexpiry-'+i+'" type="date" name="cpr_expiry[]"><span id="reqcprexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript cpr_imgs_'+res_one+' cpr_upload_certification cpr_upload_certification-'+i+'" type="file" name="cpr_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><div class="cpr_imgs'+res_one+'"></div><span id="reqcpruploadvalid-'+i+'" class="reqError text-danger valley"></span></div></div></div>');
                    $(".cpr_certification_div").append(`
                <div class="cpr_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input 
                        type="hidden" 
                        name="cprnamearr[]" 
                        class="cpr_input_${selectedValues[i]}" 
                        value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control cpr_license_number cpr_license_number-${i}" 
                                type="text" 
                                name="cpr_license_number[]">
                            <span 
                                id="reqcprlicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control cprexpiry cprexpiry-${i}" 
                                type="date" 
                                name="cpr_expiry[]">
                            <span 
                                id="reqcprexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control degree_transcript cpr_imgs_${res_one} cpr_upload_certification cpr_upload_certification-${i}" 
                                type="file" 
                                name="cpr_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="cpr_imgs${res_one}"></div>
                            <span 
                                id="reqcpruploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);


                }
            }


        });
        $('.js-example-basic-multiple[data-list-id="nrp_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var nrp_certification_array = [];
            $('.nrp_certification_div').removeClass('d-none');
            $(".nrp_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".nrp_" + res_one).remove();
                }

                nrp_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (nrp_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "nrp_imgs";

                    // $(".nrp_certification_div").append('<div class="nrp_'+res_one+' cert_div_'+selected_text+'"><h6 class="cert_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="nrpnamearr[]" class="cpr_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control nrp_license_number nrp_license_number-'+i+'" type="text" name="nrp_license_number[]"><span id="reqnrplicencevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control nrpexpiry nrpexpiry-'+i+'" type="date" name="nrp_expiry[]"><span id="reqnrpexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript nrp_imgs_'+res_one+' nrp_upload_certification nrp_upload_certification-'+i+'" type="file" name="nrp_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><div class="nrp_imgs'+res_one+'"></div><span id="reqnrpuploadvalid-'+i+'" class="reqError text-danger valley"></span></div></div></div>');
                    $(".nrp_certification_div").append(`
                <div class="nrp_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input 
                        type="hidden" 
                        name="nrpnamearr[]" 
                        class="cpr_input_${selectedValues[i]}" 
                        value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control nrp_license_number nrp_license_number-${i}" 
                                type="text" 
                                name="nrp_license_number[]">
                            <span 
                                id="reqnrplicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control nrpexpiry nrpexpiry-${i}" 
                                type="date" 
                                name="nrp_expiry[]">
                            <span 
                                id="reqnrpexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control degree_transcript nrp_imgs_${res_one} nrp_upload_certification nrp_upload_certification-${i}" 
                                type="file" 
                                name="nrp_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="nrp_imgs${res_one}"></div>
                            <span 
                                id="reqnrpuploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);


                }
            }


        });
        $('.js-example-basic-multiple[data-list-id="pls_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var pls_certification_array = [];
            $('.pls_certification_div').removeClass('d-none');
            $(".pls_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".pls_" + res_one).remove();
                }

                pls_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (pls_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "pls_imgs";

                    // $(".pls_certification_div").append('<div class="pls_'+res_one+' cert_div_'+selected_text+'"><h6 class="cert_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="plsnamearr[]" class="pls_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="license_number_div row license_number_additional"><div class="form-group col-md-12"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control pls_license_number pls_license_number-'+i+'" type="text" name="pls_license_number[]"><span id="reqplslicencevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control plsexpiry plsexpiry-'+i+'" type="date" name="pls_expiry[]"><span id="reqplsexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control degree_transcript pls_imgs_'+res_one+' pls_upload_certification pls_upload_certification-'+i+'" type="file" name="pls_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><div class="pls_imgs'+res_one+'"></div><span id="reqplsuploadvalid-'+i+'" class="reqError text-danger valley"></span></div></div></div>');
                    $(".pls_certification_div").append(`
                <div class="pls_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input 
                        type="hidden" 
                        name="plsnamearr[]" 
                        class="pls_input_${selectedValues[i]}" 
                        value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control pls_license_number pls_license_number-${i}" 
                                type="text" 
                                name="pls_license_number[]">
                            <span 
                                id="reqplslicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control plsexpiry plsexpiry-${i}" 
                                type="date" 
                                name="pls_expiry[]">
                            <span 
                                id="reqplsexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control degree_transcript pls_imgs_${res_one} pls_upload_certification pls_upload_certification-${i}" 
                                type="file" 
                                name="pls_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="pls_imgs${res_one}"></div>
                            <span 
                                id="reqplsuploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);


                }
            }


        });
        $('.js-example-basic-multiple[data-list-id="rn_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var rn_certification_array = [];
            $('.rn_certification_div').removeClass('d-none');
            $(".rn_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {

                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", ".rn_" + res_one);

                    $(".rn_" + res_one).remove();
                }

                rn_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                if (rn_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "rn_imgs";

                    $(".rn_certification_div").append(`
            <div class="rn_${res_one} cert_div_${selected_text}">
                <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                <input 
                    type="hidden" 
                    name="rnnamearr[]" 
                    class="rn_input_${selectedValues[i]}" 
                    value="${selectedValues[i]}">
                <div class="license_number_div row license_number_additional">
                    <div class="form-group col-md-12">
                        <label class="form-label" for="input-1">Certification/Licence Number</label>
                        <input 
                            class="form-control rn_license_number rn_license_number-${i}" 
                            type="text" 
                            name="rn_license_number[]">
                        <span 
                            id="reqrnlicencevalid-${i}" 
                            class="reqError text-danger valley">
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="input-1">Expiry</label>
                        <input 
                            class="form-control rnexpiry rnexpiry-${i}" 
                            type="date" 
                            name="rn_expiry[]">
                        <span 
                            id="reqrnexpiryvalid-${i}" 
                            class="reqError text-danger valley">
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="input-1">Upload your certification/Licence</label>
                        <input 
                            class="form-control degree_transcript rn_imgs_${res_one} rn_upload_certification rn_upload_certification-${i}" 
                            type="file" 
                            name="rn_upload_certification[${i}][]" 
                            onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                            multiple>
                        <div class="rn_imgs${res_one}"></div>
                        <span 
                            id="reqrnuploadvalid-${i}" 
                            class="reqError text-danger valley">
                        </span>
                    </div>
                </div>
            </div>
        `);



                }
            }


        });


        $('.js-example-basic-multiple[data-list-id="np_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var np_certification_array = [];
            $('.np_certification_div').removeClass('d-none');
            $(".np_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".np_" + res_one).remove();
                }

                np_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (np_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "np_imgs";

                    $(".np_certification_div").append(`
                <div class="np_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input 
                        type="hidden" 
                        name="npnamearr[]" 
                        class="np_input_${selectedValues[i]}" 
                        value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control np_license_number np_license_number-${i}" 
                                type="text" 
                                name="np_license_number[]">
                            <span 
                                id="reqnplicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control npexpiry npexpiry-${i}" 
                                type="date" 
                                name="np_expiry[]">
                            <span 
                                id="reqnpexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control degree_transcript np_imgs_${res_one} np_upload_certification np_upload_certification-${i}" 
                                type="file" 
                                name="np_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="np_imgs${res_one}"></div>
                            <span 
                                id="reqnpuploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);

                }
            }

        });
        $('.js-example-basic-multiple[data-list-id="cn_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var cn_certification_array = [];
            $('.cna_certification_div').removeClass('d-none');
            $(".cna_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".cna_" + res_one).remove();
                }

                cn_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (cn_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "cn_imgs";

                    $(".cna_certification_div").append(`
                <div class="cn_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input 
                        type="hidden" 
                        name="cnnamearr[]" 
                        class="cn_input_${selectedValues[i]}" 
                        value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control cn_license_number cn_license_number-${i}" 
                                type="text" 
                                name="cn_license_number[]">
                            <span 
                                id="reqcnlicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control cnexpiry cnexpiry-${i}" 
                                type="date" 
                                name="cn_expiry[]">
                            <span 
                                id="reqcnexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control degree_transcript cn_imgs_${res_one} cn_upload_certification cn_upload_certification-${i}" 
                                type="file" 
                                name="cn_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="cn_imgs${res_one}"></div>
                            <span 
                                id="reqcnuploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);

                }
            }
        });
        $('.js-example-basic-multiple[data-list-id="lpn_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var lpn_certification_array = [];
            $('.lpn_certification_div').removeClass('d-none');
            $(".lpn_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".lpn_" + res_one).remove();
                }

                lpn_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (lpn_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "lpn_imgs";

                    $(".lpn_certification_div").append(`
                <div class="lpn_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input 
                        type="hidden" 
                        name="lpnnamearr[]" 
                        class="lpn_input_${selectedValues[i]}" 
                        value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control lpn_license_number lpn_license_number-${i}" 
                                type="text" 
                                name="lpn_license_number[]">
                            <span 
                                id="reqlpnlicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control lpnexpiry lpnexpiry-${i}" 
                                type="date" 
                                name="lpn_expiry[]">
                            <span 
                                id="reqlpnexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control lpn_upload_certification degree_transcript lpn_imgs_${res_one} lpn_upload_certification-${i}" 
                                type="file" 
                                name="lpn_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="lpn_imgs${res_one}"></div>
                            <span 
                                id="reqlpnuploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);



                }
            }


        });
        $('.js-example-basic-multiple[data-list-id="crn_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var crna_certification_array = [];
            $('.crna_certification_div').removeClass('d-none');
            $(".crna_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".crna_" + res_one).remove();
                }

                crna_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (crna_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "crna_imgs";
                    $(".crna_certification_div").append(`
                <div class="crna_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input 
                        type="hidden" 
                        name="crnanamearr[]" 
                        class="crna_input_${selectedValues[i]}" 
                        value="${selectedValues[i]}">
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Certification/Licence Number</label>
                            <input 
                                class="form-control crna_license_number crna_license_number-${i}" 
                                type="text" 
                                name="crna_license_number[]">
                            <span 
                                id="reqcrnalicencevalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input 
                                class="form-control crnaexpiry crnaexpiry-${i}" 
                                type="date" 
                                name="crna_expiry[]">
                            <span 
                                id="reqcrnaexpiryvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Upload your certification/Licence</label>
                            <input 
                                class="form-control degree_transcript crna_imgs_${res_one} crna_upload_certification crna_upload_certification-${i}" 
                                type="file" 
                                name="crna_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="crna_imgs${res_one}"></div>
                            <span 
                                id="reqcrnauploadvalid-${i}" 
                                class="reqError text-danger valley">
                            </span>
                        </div>
                    </div>
                </div>
            `);

                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="cnm_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var cnm_certification_array = [];
            $('.cnm_certification_div').removeClass('d-none');
            $(".cnm_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".cnm_" + res_one).remove();
                }

                cnm_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (cnm_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "cnm_imgs";

                    $(".cnm_certification_div").append(`
                <div class="cnm_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="cnmnamearr[]" class="cnm_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="license_number_div row license_number_additional">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="license_number_${i}">Certification/Licence Number</label>
                            <input class="form-control cnm_license_number cnm_license_number-${i}" 
                                id="license_number_${i}" 
                                type="text" 
                                name="cnm_license_number[]">
                            <span id="reqcnmlicencevalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-label" for="expiry_date_${i}">Expiry</label>
                            <input class="form-control cnmexpiry cnmexpiry-${i}" 
                                id="expiry_date_${i}" 
                                type="date" 
                                name="cnm_expiry[]">
                            <span id="reqcnmexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-label" for="upload_cert_${i}">Upload your Certification/Licence</label>
                            <input class="form-control degree_transcript cnm_imgs_${res_one}" 
                                id="upload_cert_${i}" 
                                type="file" 
                                name="cnm_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="cnm_imgs${res_one}"></div>
                            <span id="reqcnmuploadvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
            `);



                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="ons_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var ons_certification_array = [];
            $('.ons_certification_div').removeClass('d-none');
            $(".ons_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".ons_" + res_one).remove();
                }

                ons_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (ons_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "ons_imgs";

                    $(".ons_certification_div").append(`
                <div class="ons_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="onsnamearr[]" class="ons_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="license_number_div row license_number_additional">
                        <!-- Certification/Licence Number Input -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="ons_license_number_${i}">Certification/Licence Number</label>
                            <input class="form-control ons_license_number ons_license_number-${i}" 
                                id="ons_license_number_${i}" 
                                type="text" 
                                name="ons_license_number[]">
                            <span id="reqonslicencevalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- Expiry Date Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="ons_expiry_${i}">Expiry</label>
                            <input class="form-control onsexpiry onsexpiry-${i}" 
                                id="ons_expiry_${i}" 
                                type="date" 
                                name="ons_expiry[]">
                            <span id="reqonsexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- File Upload Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="ons_upload_cert_${i}">Upload your Certification/Licence</label>
                            <input class="form-control degree_transcript ons_imgs_${res_one}" 
                                id="ons_upload_cert_${i}" 
                                type="file" 
                                name="ons_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="ons_imgs${res_one}"></div>
                            <span id="reqonsuploadvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
            `);

                }
            }

        });

        $('.js-example-basic-multiple[data-list-id="msw_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var msw_certification_array = [];
            $('.msw_certification_div').removeClass('d-none');
            $(".msw_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".msw_" + res_one).remove();
                }

                msw_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);

                if (msw_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "msw_imgs";

                    $(".msw_certification_div").append(`
                <div class="msw_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="mswnamearr[]" class="msw_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="license_number_div row license_number_additional">
                        <!-- Certification/Licence Number Input -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="msw_license_number_${i}">Certification/Licence Number</label>
                            <input class="form-control msw_license_number msw_license_number-${i}" 
                                id="msw_license_number_${i}" 
                                type="text" 
                                name="msw_license_number[]">
                            <span id="reqmswlicencevalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- Expiry Date Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="msw_expiry_${i}">Expiry</label>
                            <input class="form-control mswexpiry mswexpiry-${i}" 
                                id="msw_expiry_${i}" 
                                type="date" 
                                name="msw_expiry[]">
                            <span id="reqmswexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- File Upload Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="msw_upload_certification_${i}">Upload your Certification/Licence</label>
                            <input class="form-control degree_transcript msw_imgs_${res_one} msw_upload_certification msw_upload_certification-${i}" 
                                id="msw_upload_certification_${i}" 
                                type="file" 
                                name="msw_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="msw_imgs${res_one}"></div>
                            <span id="reqmswuploadvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
            `);
                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="ain_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var ain_certification_array = [];
            $('.ain_certification_div').removeClass('d-none');
            $(".ain_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".ain_" + res_one).remove();
                }

                ain_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (ain_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "ain_imgs";

                    $(".ain_certification_div").append(`
                <div class="ain_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="ainnamearr[]" class="ain_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="license_number_div row license_number_additional">
                        <!-- Certification/Licence Number Input -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="ain_license_number_${i}">Certification/Licence Number</label>
                            <input class="form-control ain_license_number ain_license_number-${i}" 
                                id="ain_license_number_${i}" 
                                type="text" 
                                name="ain_license_number[]">
                            <span id="reqainlicencevalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- Expiry Date Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="ain_expiry_${i}">Expiry</label>
                            <input class="form-control ainexpiry ainexpiry-${i}" 
                                id="ain_expiry_${i}" 
                                type="date" 
                                name="ain_expiry[]">
                            <span id="reqainexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- File Upload Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="ain_upload_certification_${i}">Upload your Certification/Licence</label>
                            <input class="form-control degree_transcript ain_imgs_${res_one} ain_upload_certification ain_upload_certification-${i}" 
                                id="ain_upload_certification_${i}" 
                                type="file" 
                                name="ain_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="ain_imgs${res_one}"></div>
                            <span id="reqainuploadvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
            `);
                }
            }


        });

        $('.js-example-basic-multiple[data-list-id="rpn_data"]').on('change', function() {
            let selectedValues = $(this).val();
            var rpn_certification_array = [];
            $('.rpn_certification_div').removeClass('d-none');
            $(".rpn_certification_div h6").each(function() {
                var text = $(this).text();

                if (selectedValues.includes(text) == false) {
                    let res = text.split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    $(".rpn_" + res_one).remove();
                }

                rpn_certification_array.push(text);
            });
            console.log("selectedValues", selectedValues);

            //$(".bls_certification_div").empty();
            for (var i = 0; i < selectedValues.length; i++) {
                var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                let res = selectedValues[i].split(' ')[0];
                let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                console.log("res_one", res_one);
                if (rpn_certification_array.includes(selectedValues[i]) == false) {
                    var user_id = "{{ $sessid }}";
                    var img_text = "rpn_imgs";

                    $(".rpn_certification_div").append(`
                <div class="rpn_${res_one} cert_div_${selected_text}">
                    <h6 class="cert_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="rpnnamearr[]" class="rpn_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="license_number_div row license_number_additional">
                        <!-- Certification/Licence Number Input -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="rpn_license_number_${i}">Certification/Licence Number</label>
                            <input class="form-control rpn_license_number rpn_license_number-${i}" 
                                id="rpn_license_number_${i}" 
                                type="text" 
                                name="rpn_license_number[]">
                            <span id="reqrpnlicencevalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- Expiry Date Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="rpn_expiry_${i}">Expiry</label>
                            <input class="form-control rpnexpiry rpnexpiry-${i}" 
                                id="rpn_expiry_${i}" 
                                type="date" 
                                name="rpn_expiry[]">
                            <span id="reqrpnexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                        
                        <!-- File Upload Input -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="rpn_upload_certification_${i}">Upload your Certification/Licence</label>
                            <input class="form-control degree_transcript rpn_imgs_${res_one} rpn_upload_certification rpn_upload_certification-${i}" 
                                id="rpn_upload_certification_${i}" 
                                type="file" 
                                name="rpn_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id}, ${i}, '${img_text}', '${res_one}')" 
                                multiple>
                            <div class="rpn_imgs${res_one}"></div>
                            <span id="reqrpnuploadvalid-${i}" class="reqError text-danger valley"></span>
                        </div>
                    </div>
                </div>
            `);
                }
            }


        });
    </script>

    <script>
        $(document).ready(function() {
            $('#residencyId').change(function() {
                var residencyId = $(this).val();
                $('#passport_detail_date').hide();
                $('#passport_detail').hide();
                if (residencyId !== 'Citizen') {
                    if (residencyId == 'Visa Holder') {
                        $('#passport_detail_date').show();
                    }
                    $('#passport_detail').show();

                }
            });
        });

        function get_new_plice_check() {
            $('#get_new_plice_checkModel').modal('show');
        }
    </script>

    <script>
        var phoneInputID2 = "#reference_contactI";
        var input2 = document.querySelector(phoneInputID2);
        var iti2 = window.intlTelInput(input2, {
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            hiddenInput: "full_number",
            initialCountry: "",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            preferredCountries: ['AU'],
            // separateDialCode: true,
            utilsScript: ""
        });

        $(phoneInputID2).on("countrychange", function(event) {

            // Get the selected country data to know which country is selected.
            var selectedCountryData = iti2.getSelectedCountryData();
            console.log("selectedCountryData", selectedCountryData.dialCode);
            $("#reference_countryCode").val(selectedCountryData.dialCode);
            $("#reference_countryiso").val(selectedCountryData.iso2);
            //alert($("#contactI").intlTelInput("getSelectedCountryData").dialCode);
            // Get an example number for the selected country to use as placeholder.
            // newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

            //   // Reset the phone number input.
            //   iti.setNumber("");

            // // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
            // mask = newPlaceholder.replace(/[1-9]/g, "0");

            // // Apply the new mask for the input
            // $(this).mask(mask);
        });


        // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
        // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
        // plugin instance.

        iti2.promise.then(function() {
            $(phoneInputID2).trigger("countrychange");
        });
    </script>

    <script>
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
    </script>

    <script type="text/javascript">
        $("#unavailableNow").click(function() {
            if ($("#unavailableNow").prop('checked') == true) {
                $(".available_date_field").removeClass("d-none");
            } else {
                $(".available_date_field").addClass("d-none");
            }
        });
        $("#availableNow").click(function() {
            $(".available_date_field").addClass("d-none");
        });
        if ($("#unavailableNow").prop('checked') == true) {
            $(".available_date_field").removeClass("d-none");
        }
    </script>


    {{-- edit nurse  --}}

    <script>
        $(document).ready(function() {

            $('#uploadeditButton').on('click', function() {
                $('#update_profile_image').click();
            });

            $('#update_profile_image').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImage').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('.edit-form-1').on('click', function() {

                var returnValue = true;

                $(".valley").html("");
                // alert($('#stateI').val());     
                var targetTab = $(this).data('target');
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                // Get the value of the selected radio button
                var selectedGender = $('input[name="gender"]:checked').val();
                var contact = $('#contact').val();

                //  alert(profile_image);
                var profile_image = $('#update_profile_image').val();
                var dob = $('#dob').val();
                var per_website = $('#per_website').val();
                var countryI = $('#countryI').val();
                var stateI = $('#stateI').val();
                var city = $('#city').val();
                var zip_code = $('#zip_code').val();
                var home_address = $('#home_address').val();
                var emrg_contact = $('#emrg_contact').val();
                var emrg_email = $('#emrg_email').val();
                var passwordI = document.getElementById("passwordI").value;
                var confirm_passwordI = document.getElementById("confirm_passwordI").value;
                var nationality = $('#nationality').val();

                if (first_name.trim() === "") {
                    $("#first_name_error").html("* Please Enter the First name.");
                    returnValue = false;
                }

                if (nationality === "") {
                    $("#nationality_error").html("* Please Select the nationality.");
                    returnValue = false;
                }

                if (last_name.trim() === "") {
                    $("#last_name_error").html("* Please Enter the Last name.");
                    returnValue = false;
                }

                if (email.trim() === "") {
                    $("#email_error").html("* Please Enter the Email.");
                    returnValue = false;
                }

                if (!selectedGender) { // Check if no gender is selected
                    $("#genderErr").html("* Please select gender."); // Show error message
                    returnValue = false; // Set returnValue to false
                }

                if (contact.trim() === "") {
                    $("#contact_error").html("* Please Enter the phone number.");
                    returnValue = false;
                }

                //  if(profile_image === "") {
                //     $("#profile_image_error").html("* Please Upload  the profile image.");
                //     returnValue = false;
                //  }

                if (dob.trim() === "") {
                    $("#date_error").html("* Please Enter the date of birth.");
                    returnValue = false;
                }

                if (per_website.trim() === "") {
                    $("#per_website_error").html("* Please Enter the personal website.");
                    returnValue = false;
                }

                if (countryI.trim() === "") {
                    $("#country_error").html("* Please Select the country.");
                    returnValue = false;
                }

                if (city.trim() === "") {
                    $("#city_error").html("* Please Enter the city.");
                    returnValue = false;
                }

                if (zip_code.trim() === "") {
                    $("#zip_code_error").html("* Please Enter the zip code.");
                    returnValue = false;
                }

                if (home_address.trim() === "") {
                    $("#home_address_error").html("* Please Enter the home address.");
                    returnValue = false;
                }

                if (emrg_contact.trim() === "") {
                    $("#emrg_contact_error").html("* Please Enter the Emergency mobile number.");
                    returnValue = false;
                }

                if (emrg_email.trim() === "") {
                    $("#emrg_email_error").html("* Please Enter the Emergency email.");
                    returnValue = false;
                }


                if (passwordI != "") {


                    var pattern = /^.*(?=.{7,12})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&!-_]).*$/;

                    if (!pattern.test(passwordI)) {

                        document.getElementById("reqTxtpasswordI").innerHTML = "Password length should be 7 Characters with atleast 1 number, lower, upper & special(@#$%&!-_&) characters.";

                        returnValue = false;

                    }

                    if (confirm_passwordI == "") {

                        document.getElementById("reqTxtconfirm_passwordI").innerHTML = "* Please Enter the Confirm password.";

                        returnValue = false;

                    }

                    if (passwordI != confirm_passwordI) {

                        document.getElementById("reqTxtconfirm_passwordI").innerHTML = "Password and Confirm password do not match.";

                        returnValue = false;

                    }

                }

                if (!returnValue) {
                    // $('.submit-btn-120').prop('disabled', false);
                    // $('.submit-btn-1').hide();
                    // $('.resetpassword').show();
                    return false;
                }


                if (returnValue) {
                    // Create a new FormData object
                    var formData = new FormData();

                    // if(targetTab ==  '#navpill-2'){
                    // Append form fields to the FormData object
                    formData.append('first_name', $('#first_name').val());
                    formData.append('last_name', $('#last_name').val());
                    formData.append('email', $('#email').val());
                    formData.append('gender', $('input[name="gender"]:checked').val());
                    formData.append('contact', $('#contact').val());
                    formData.append('country_code_phone', $('#country_code_phone').val());
                    formData.append('country_iso_phone', $('#country_iso_phone').val());
                    formData.append('dob', $('#dob').val());
                    formData.append('per_website', $('#per_website').val());
                    formData.append('country', countryI);
                    formData.append('state', stateI);
                    formData.append('city', $('#city').val());
                    formData.append('zip_code', $('#zip_code').val());
                    formData.append('home_address', $('#home_address').val());
                    formData.append('emrg_contact', $('#emrg_contact').val());
                    formData.append('emrg_email', $('#emrg_email').val());
                    formData.append('country_code_mobile', $('#country_code_mobile').val());
                    formData.append('country_iso_mobile', $('#country_iso_mobile').val());
                    formData.append('tab', 'tab1');
                    formData.append('nationality', $('#nationality').val());
                    formData.append('nurse_id', $('#nurse_id').val());
                    formData.append('passwordI', passwordI);

                    if (profile_image != "") {
                        // Append the file
                        var profile_image = $('#update_profile_image')[0].files[0];

                        if (profile_image) {
                            formData.append('profile_image', profile_image);
                        }

                    } else {
                        formData.append('profile_image', 'null');
                    }

                    $.ajax({
                        url: "{{ route('admin.edit_nurse_post') }}",
                        type: "POST",
                        data: formData,
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                        },
                        success: function(res) {
                            console.log(res.type);

                            if (res.status == '2') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(function() {
                                    var targetTab = 'tab-1';
                                    var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;
                                    window.location.href = newUrl;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message,
                                });
                            }
                            // Show the target tab
                        },
                        error: function(error) {
                            // if(targetTab ==  '#navpill-2'){
                            if (error.responseJSON.errors) {
                                if (error.responseJSON.errors.first_name) {
                                    $('#first_name_error').text(error.responseJSON.errors.first_name[0]);
                                } else {
                                    $('#first_name_error').text('');
                                }

                                if (error.responseJSON.errors.last_name) {
                                    $('#last_name_error').text(error.responseJSON.errors.last_name[0]);

                                } else {
                                    $('#last_name_error').text('');
                                }

                                if (error.responseJSON.errors.contact) {
                                    $('#contact_error').text(error.responseJSON.errors.contact[0]);

                                } else {
                                    $('#contact_error').text('');
                                }

                                if (error.responseJSON.errors.email) {
                                    $('#email_error').text(error.responseJSON.errors.email[0]);

                                } else {
                                    $('#email_error').text('');
                                }

                                if (error.responseJSON.errors.gender) {
                                    $('#genderErr').text(error.responseJSON.errors.gender[0]);

                                } else {
                                    $('#genderErr').text('');
                                }

                                if (error.responseJSON.errors.dob) {
                                    $('#date_error').text(error.responseJSON.errors.dob[0]);

                                } else {
                                    $('#date_error').text('');
                                }

                                if (error.responseJSON.errors.per_website) {
                                    $('#per_website_error').text(error.responseJSON.errors.per_website[0]);

                                } else {
                                    $('#per_website_error').text('');
                                }

                                if (error.responseJSON.errors.country) {
                                    $('#country_error').text(error.responseJSON.errors.country[0]);

                                } else {
                                    $('#country_error').text('');
                                }

                                if (error.responseJSON.errors.state) {
                                    $('#state_error').text(error.responseJSON.errors.state[0]);

                                } else {
                                    $('#state_error').text('');
                                }

                                if (error.responseJSON.errors.city) {
                                    $('#city_error').text(error.responseJSON.errors.city[0]);

                                } else {
                                    $('#city_error').text('');
                                }

                                if (error.responseJSON.errors.zip_code) {
                                    $('#zip_code_error').text(error.responseJSON.errors.zip_code[0]);

                                } else {
                                    $('#zip_code_error').text('');
                                }

                                if (error.responseJSON.errors.home_address) {
                                    $('#home_address_error').text(error.responseJSON.errors.home_address[0]);

                                } else {
                                    $('#home_address_error').text('');
                                }

                                if (error.responseJSON.errors.emrg_contact) {
                                    $('#emrg_contact_error').text(error.responseJSON.errors.emrg_contact[0]);

                                } else {
                                    $('#emrg_contact_error').text('');
                                }

                                if (error.responseJSON.errors.emrg_email) {
                                    $('#emrg_email_error').text(error.responseJSON.errors.emrg_email[0]);

                                } else {
                                    $('#emrg_email_error').text('');
                                }


                                if (error.responseJSON.errors.home_address) {
                                    $('#home_address_error').text(error.responseJSON.errors.zip_code[0]);

                                } else {
                                    $('#home_address_error').text('');
                                }

                                if (error.responseJSON.errors.profile_image) {
                                    $('#profile_image_error').text(error.responseJSON.errors.profile_image[0]);

                                } else {
                                    $('#profile_image_error').text('');
                                }
                                // }

                            }
                        }
                    });

                }

                // if (!hasErrors) {
                //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
                // }

            });

            // second form
            $('.edit-form-2').on('click', function(event) {

                // /event.preventDefault(); // Prevent default form submission

                var targetTab = $(this).data('target');

                // // Function to enable the next tab
                function enableNextTab(targetTab) {
                    $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
                }
                var returnValue = true;

                $(".valley").html("");

                var visibleToAgencies = $('[name="agencies"]').val();

                var isChecked = $('#visibleToAgencies').is(':checked');


                if (isChecked) {
                    visibleToAgencies = 'Yes';
                } else {
                    visibleToAgencies = 'No';
                }


                var individuals = $('[name="individuals"]').val();

                var isChecked = $('#visibleToIndividuals').is(':checked');

                if (isChecked) {
                    individuals = 'Yes';
                } else {
                    individuals = 'No';
                }


                // var profile_status = $('[name="profile_status"]').val();

                var profileStatus = $('input[name="profile_status"]:checked').val();

                if (profileStatus !== undefined) {
                    var profile_status = profileStatus;
                } else {
                    var profile_status = profileStatus;
                }

                var available_date = $('[name="available_date"]').val();

                var medical_facilities = $('[name="medical_facilities"]').val();

                var isChecked = $('#visibleToMedicalFacilities').is(':checked');

                if (isChecked) {
                    medical_facilities = 'Yes';
                } else {
                    medical_facilities = 'No';
                }

                // var stateworkprefer = selectElement3.val();

                // Create a new FormData object
                var formData = new FormData();
                formData.append('visibleToAgencies', visibleToAgencies);
                formData.append('individuals', individuals);
                formData.append('profile_status', profile_status);
                formData.append('available_date', available_date);
                formData.append('medical_facilities', medical_facilities);
                formData.append('nurse_id', $('#nurse_id').val());

                formData.append('tab', 'tab14');

                $.ajax({
                    url: "{{ route('admin.edit_nurse_post') }}",
                    type: "POST",
                    data: formData,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                    },
                    success: function(res) {
                        console.log(res.type);

                        if (res.status == '2') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(function() {
                                var targetTab = 'tab-2';
                                var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;
                                window.location.href = newUrl;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                        // Show the target tab
                    },
                    error: function(error) {

                    }
                });


            });

            // thired form        
            $('.edit-form-3').on('click', function() {
                var targetTab = $(this).data('target');
                // Initially deactivate all tabs except the first one
                // Function to enable the next tab
                function enableNextTab(targetTab) {
                    // Remove 'active' class
                    // $('a[href="navpill-1"]').removeClass('active');

                    // // Add 'disabled' class
                    // $('a[href="navpill-1"]').addClass('disabled');
                }

                // Function to enable the next tab
                function enableNextTab(targetTab) {
                    $('a[href="' + targetTab + '"]').removeClass('disabled').tab('show');
                }

                // TYPE OF NURSE
                var selectElement = $('select[data-list-id="type-of-nurse"]');
                // Get the selected value(s) from the Select2 element
                var type_nurse = selectElement.val();

                var selectElement1 = $('select[data-list-id="nursing_entry-1"]');
                // Get the selected value(s) from the Select2 element
                var nursing_entry_first = selectElement1.val();

                var selectElement2 = $('select[data-list-id="nursing_entry-2"]');
                // Get the selected value(s) from the Select2 element
                var nursing_entry_sec = selectElement2.val();


                var selectElement3 = $('select[data-list-id="nursing_entry-3"]');
                // Get the selected value(s) from the Select2 element
                var nursing_entry_thired = selectElement3.val();

                var selectElement4 = $('select[data-list-id="nurse_practitioner_menu"]');
                // Get the selected value(s) from the Select2 element
                var nurse_practitioner_menu = selectElement4.val();

                // Specialties 
                var specialtiest_1 = $('select[data-list-id="specialties"]');
                // Get the selected value(s) from the Select2 element
                var specialties = specialtiest_1.val();

                var specialtiest_2 = $('select[data-list-id="speciality_entry-1"]');
                // Get the selected value(s) from the Select2 element
                var adults = specialtiest_2.val();

                var specialtiest_3 = $('select[data-list-id="surgical_row_box"]');
                // Get the selected value(s) from the Select2 element
                var surgical_data = specialtiest_3.val();

                var specialtiest_4 = $('select[data-list-id="surgical_operative_care-1"]');
                // Get the selected value(s) from the Select2 element
                var surgical_operative_care_1 = specialtiest_4.val();

                var specialtiest_5 = $('select[data-list-id="surgical_operative_care-2"]');
                // Get the selected value(s) from the Select2 element
                var surgical_operative_care_2 = specialtiest_5.val();


                var specialtiest_6 = $('select[data-list-id="surgical_operative_care-3"]');
                // Get the selected value(s) from the Select2 element
                var surgical_operative_care_3 = specialtiest_6.val();

                var specialtiest_7 = $('select[data-list-id="speciality_entry-2"]');
                // Get the selected value(s) from the Select2 element
                var speciality_entry_2 = specialtiest_7.val();

                var specialtiest_8 = $('select[data-list-id="surgical_obs_care"]');
                // Get the selected value(s) from the Select2 element
                var surgical_obs_care = specialtiest_8.val();

                var specialtiest_9 = $('select[data-list-id="speciality_entry-3"]');
                // Get the selected value(s) from the Select2 element
                var speciality_entry_3 = specialtiest_9.val();

                var specialtiest_10 = $('select[data-list-id="neonatal_care"]');
                // Get the selected value(s) from the Select2 element
                var neonatal_care = specialtiest_10.val();

                var specialtiest_11 = $('select[data-list-id="surgical_rowpad_box"]');
                // Get the selected value(s) from the Select2 element
                var surgical_rowpad_box = specialtiest_11.val();

                var specialtiest_12 = $('select[data-list-id="surgical_operative_carep-1"]');
                // Get the selected value(s) from the Select2 element
                var surgical_operative_carep_1 = specialtiest_12.val();

                var specialtiest_13 = $('select[data-list-id="surgical_operative_carep-2"]');
                // Get the selected value(s) from the Select2 element
                var surgical_operative_carep_2 = specialtiest_13.val();

                var specialtiest_14 = $('select[data-list-id="surgical_operative_carep-3"]');
                // Get the selected value(s) from the Select2 element
                var surgical_operative_carep_3 = specialtiest_14.val();

                var specialtiest_15 = $('select[data-list-id="speciality_entry-4"]');
                // Get the selected value(s) from the Select2 element
                var speciality_entry_4 = specialtiest_15.val();

                var employee_status = $('#employee_status').val();

                var bio = $('#bio').val();

                var assistent_level = $('#assistent_level').val();

                var declare_information = $('#declare_information').val();

                var isValid = true;

                if ($('[name="nurseType[]"]').val() == '') {
                    document.getElementById("type_nurse_error").innerHTML = "* Please select one or more Type of nurse";
                    isValid = false;
                }

                if ($('[name="specialties[]"]').val() == '') {
                    document.getElementById("specialties_error").innerHTML = "* Please select one or more specialties.";
                    isValid = false;
                }

                // if ($('[name="degree[]"]').val() == '') {
                //   document.getElementById("reqdegree").innerHTML = "* Please select degree.";
                //   isValid = false;
                // }

                if ($('[name="bio"]').val() == '') {
                    document.getElementById("bio_error").innerHTML = "* Please enter the bio.";
                    isValid = false;
                }

                if ($('[name="employee_status"]').val() == '') {
                    document.getElementById("status_error").innerHTML = "* Please select the employee status.";
                    isValid = false;
                }

                if ($(".declare_information").prop('checked') == false) {
                    document.getElementById("diclare_error").innerHTML = "* Please check this checkbox";
                    isValid = false;
                }

                if (isValid == true) {
                    // Create a new FormData object
                    var formData = new FormData();

                    // if(targetTab ==  '#navpill-2'){

                    formData.append('states', type_nurse);
                    formData.append('entry_level_nursing', nursing_entry_first);
                    formData.append('registered_nurses', nursing_entry_sec);
                    formData.append('advanced_practioner', nursing_entry_thired);
                    formData.append('nurse_prac', nurse_practitioner_menu);
                    formData.append('specialties', specialties);
                    formData.append('adults', adults);
                    formData.append('surgical_preoperative', surgical_data);
                    formData.append('operating_room', surgical_operative_care_1);
                    formData.append('operating_room_scout', surgical_operative_care_2);
                    formData.append('operating_room_scrub', surgical_operative_care_3);
                    formData.append('maternity', speciality_entry_2);
                    formData.append('surgical_obstrics_gynacology', surgical_obs_care);
                    formData.append('paediatrics_neonatal', speciality_entry_3);
                    formData.append('neonatal_care', neonatal_care);
                    formData.append('paedia_surgical_preoperative', surgical_rowpad_box);
                    formData.append('pad_op_room', surgical_operative_carep_1);
                    formData.append('tab', 'tab2');
                    formData.append('pad_qr_scout', surgical_operative_carep_2);
                    formData.append('pad_qr_scrub', surgical_operative_carep_3);
                    formData.append('community', speciality_entry_4);
                    formData.append('current_employee_status', employee_status);
                    formData.append('bio', bio);
                    formData.append('assistent_level', assistent_level);
                    formData.append('declare_information', declare_information);
                    formData.append('nurse_id', $('#nurse_id').val());

                    $.ajax({
                        url: "{{ route('admin.edit_nurse_post') }}",
                        type: "POST",
                        data: formData,
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                        },
                        success: function(res) {
                            console.log(res.type);

                            if (res.status == '2') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(function() {
                                    var targetTab = 'tab-3';
                                    var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + targetTab;
                                    window.location.href = newUrl;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message,
                                });
                            }
                            // Show the target tab
                        },
                        error: function(error) {
                            // if(targetTab ==  '#navpill-2'){
                            if (error.responseJSON.errors) {
                                if (error.responseJSON.errors.states) {
                                    $('#type_nurse_error').text(error.responseJSON.errors.states[0]);
                                } else {
                                    $('#type_nurse_error').text('');
                                }

                                if (error.responseJSON.errors.specialties) {
                                    $('#specialties_error').text(error.responseJSON.errors.specialties[0]);

                                } else {
                                    $('#specialties_error').text('');
                                }

                                if (error.responseJSON.errors.bio) {
                                    $('#bio_error').text(error.responseJSON.errors.bio[0]);

                                } else {
                                    $('#bio_error').text('');
                                }

                                if (error.responseJSON.errors.declare_information) {
                                    $('#diclare_error').text(error.responseJSON.errors.declare_information[0]);

                                } else {
                                    $('#diclare_error').text('');
                                }


                                // }                        
                            }
                        }
                    });

                }

                // if (!hasErrors) {
                //     $('a[href="' + targetTab + '"]').tab('show'); // Show the target tab
                // }

            });

        })
    </script>
    {{--
<script>
var licence_div_count = $(".license_number_anothercertifications").length;
console.log("licence_div_count",licence_div_count);
function add_listcertfication(){
    licence_div_count++;
    $(".another_certifications").append('<div class="license_number_div row license_number_anothercertifications mt-3"><div class="form-group col-md-6"><label class="form-label" for="input-1">Certificate '+licence_div_count+'</label><input class="form-control" type="text" name="training_certificate[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Certification/Licence Number</label><input class="form-control" type="text" name="certificate_license_number[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control" type="date" name="certificate_expiry[]"></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload your certification/Licence</label><input class="form-control" type="file" name="certificate_upload_certification[]"></div></div>');
    
}
</script> --}}
    <!-- for multiple upload image -->
    <script>
        function changeDegreeImg(user_id) {
            var files = $('#upload_degree')[0].files;
            console.log("files", files.length);

            var form_data = "";

            form_data = new FormData();

            for (var i = 0; i < files.length; i++) {
                form_data.append("upload_degree[]", files[i], files[i]['name']);

            }

            form_data.append("user_id", user_id);
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                type: "post",
                url: "{{ route('admin.upload-deg-img') }}",
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
                        htmlData += '<div class="trans_img trans_img-' + (i + 1) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteDegImg(' + (i + 1) + ',' + user_id + ',\'' + img_name + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
                    }
                    $(".degree_transcript_imgs").html(htmlData);


                }
            });

        }

        function deleteDegImg(i, user_id, img) {
            // alert(img);


            $.ajax({
                type: "post",
                url: "{{ route('admin.dlt-deg-img') }}",
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
                url: "{{ route('admin.uploadImgs1') }}",
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

        function deleteImg1(i, user_id, img, country_name, img_text) {
            //alert(".trans_img"+img_text+country_name+i);    
            $.ajax({
                type: "post",
                url: "{{ route('admin.deleteImg1') }}",
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

        function changeAnoImg(user_id, i, field_name, cat_name) {
            var files = $('.' + field_name + '_' + cat_name)[0].files;

            var form_data = "";

            form_data = new FormData();

            for (var i = 0; i < files.length; i++) {
                form_data.append("upload_images[]", files[i], files[i]['name']);
            }

            form_data.append("user_id", user_id);
            form_data.append("cat_name", cat_name);
            form_data.append("field_name", field_name);
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                type: "post",
                url: "{{ route('admin.uploadImgs1') }}",
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
                        console.log("img_name", 'deleteanoImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
                        htmlData += '<div class="trans_img edu_img-' + (i + 1) + ' edu_img' + field_name + 'tran_' + (i) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteanoImg1(' + i + ',' + user_id + ',\'' + image_array[i] + '\',\'' + cat_name + '\',\'' + img_text + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
                    }
                    $("." + field_name + cat_name).html(htmlData);
                }
            });

        }

        function delete_certification1(i) {
            $(".license_number_div_" + i).remove();
        }

        $(document).ready(function() {
            // Mandatory Training and Education
            $('.js-example-basic-multiple[data-list-id="mandatory_courses"]').on('change', function() {
                let selectedValues = $(this).val();

                console.log("selectedValues", selectedValues);
                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
                if (selectedValues.includes("419")) {
                    $('.mandatory_tr_div_1').removeClass('d-none');
                    // $('.license_number_acls').removeClass('d-none');
                } else {
                    $('.mandatory_tr_div_1').addClass('d-none');
                    // $('.license_number_acls').addClass('d-none');
                    $('.well_self_care_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').select2().val(null).trigger('change');
                }
                if (selectedValues.includes("418")) {
                    $('.mandatory_tr_div_2').removeClass('d-none');
                    // $('.license_number_bls').removeClass('d-none');
                } else {
                    $('.mandatory_tr_div_2').addClass('d-none');
                    // $('.license_number_bls').addClass('d-none');
                    $('.tech_innvo_health_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').select2().val(null).trigger('change');
                }
                if (selectedValues.includes("417")) {
                    $('.mandatory_tr_div_3').removeClass('d-none');
                    // $('.license_number_cpr').removeClass('d-none');
                } else {
                    $('.mandatory_tr_div_3').addClass('d-none');
                    // $('.license_number_cpr').addClass('d-none');
                    $('.leader_pro_dev_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').select2().val(null).trigger('change');
                }

                if (selectedValues.includes("416")) {
                    $('.mandatory_tr_div_4').removeClass('d-none');
                    // $('.license_number_nrp').removeClass('d-none');

                } else {
                    $('.mandatory_tr_div_4').addClass('d-none');
                    // $('.license_number_nrp').addClass('d-none');
                    $('.mid_spec_tra_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').select2().val(null).trigger('change');

                }
                if (selectedValues.includes("415")) {
                    $('.mandatory_tr_div_5').removeClass('d-none');
                    // $('.license_number_pals').removeClass('d-none');


                } else {
                    $('.mandatory_tr_div_5').addClass('d-none');
                    // $('.license_number_pals').addClass('d-none'); 
                    $('.clinic_skill_core_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').select2().val(null).trigger('change');
                }

            });

            $('.js-example-basic-multiple[data-list-id="well_self_care_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var well_self_care = [];
                $('.well_self_care_div').removeClass('d-none');
                $(".well_self_care_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        console.log("res_one", res_one);

                        $(".well_self_care_" + res_one).remove();
                    }
                    well_self_care.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".well_self_care_div").empty();

                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    if (well_self_care.includes(selectedValues[i]) == false) {

                        var user_id = "{{ $sessid }}";
                        var img_text = "well_imgs";
                        $(".well_self_care_div").append('<div class="well_self_care_' + res_one + ' well_div_' + selected_text + '"><h6 class="well_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="wellnamearr[]" class="wellness_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="wellness_inst_div row wellness_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control well_institution well_institution-' + i + '" type="text" name="well_institution[]"><span id="wellinstitutionvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control well_tra_start_date well_tra_start_date-' + i + '" type="date" name="well_tra_start_date[]"><span id="well_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control well_tra_end_date well_tra_end_date-' + i + '" type="date" name="well_tra_end_date[]"><span id="well_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-' + i + '" type="date" name="well_expiry[]"><span id="wellexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_' + res_one + ' well_upload_certification-' + i + '" type="file" name="well_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqwelluploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="well_imgs' + res_one + '"></div></div></div></div>');
                    }
                }


            });

            $('.js-example-basic-multiple[data-list-id="tech_innvo_health_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var tech_innvo_health = [];
                $('.tech_innvo_health_div').removeClass('d-none');
                $(".tech_innvo_health_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        console.log("res_one", res_one);

                        $(".tech_innvo_health_" + res_one).remove();
                    }
                    tech_innvo_health.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".tech_innvo_health_div").empty();
                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    if (tech_innvo_health.includes(selectedValues[i]) == false) {
                        var user_id = "{{ $sessid }}";
                        var img_text = "tech_innvo_imgs";
                        $(".tech_innvo_health_div").append('<div class="tech_innvo_health_' + res_one + ' tech_innvo_div_' + selected_text + '"><h6 class="tech_innvo_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="techinnvonamearr[]" class="tech_innvo_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="tech_innvo_div row tech_innvo_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control tech_innvo_institution tech_innvo-' + i + '" type="text" name="tech_innvo_institution[]"><span id="techinnvoinstitutionvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tech_innvo_tra_start_date tech_innvo_tra_start_date-' + i + '" type="date" name="tech_innvo_tra_start_date[]"><span id="tech_innvo_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control tech_innvo_tra_end_date tech_innvo_tra_end_date-' + i + '" type="date" name="tech_innvo_tra_end_date[]"><span id="tech_innvo_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tech_innvo_expiry tech_innvo_expiry-' + i + '" type="date" name="tech_innvo_expiry[]"><span id="techinnvoexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control tech_innvo_upload_certification tech_innvo_imgs_' + res_one + ' tech_innvo_upload_certification-' + i + '" type="file" name="tech_innvo_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqtechinnvouploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="tech_innvo_imgs' + res_one + '"></div></div></div></div>');
                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="leader_pro_dev_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var leader_pro_dev = [];
                $('.leader_pro_dev_div').removeClass('d-none');
                $(".leader_pro_dev_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        // alert(text);

                        let res = text.split(' ')[0];

                        let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                        let res_2 = text.split(' ')[1];

                        res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                        let chunks = res_2.substring(0, 4);

                        let res_one = res_1 + '_' + chunks;

                        $(".leader_pro_dev_" + res_one).remove();
                    }
                    leader_pro_dev.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".leader_pro_dev_div").empty();
                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();

                    let res = selectedValues[i].split(' ')[0];

                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let res_2 = selectedValues[i].split(' ')[1];

                    res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    let chunks = res_2.substring(0, 4);

                    let res_one = res_1 + '_' + chunks;

                    if (leader_pro_dev.includes(selectedValues[i]) == false) {
                        var user_id = "{{ $sessid }}";
                        var img_text = "leader_pro_imgs";
                        $(".leader_pro_dev_div").append('<div class="leader_pro_dev_' + res_one + ' leader_pro_div_' + selected_text + '"><h6 class="leader_pro_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="leaderpronamearr[]" class="leader_pro_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="leader_pro_div row leader_pro_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control leader_pro_institution leader_pro-' + i + '" type="text" name="leader_pro_institution[]"><span id="leaderproinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control leader_pro_tra_start_date leader_pro_tra_start_date-' + i + '" type="date" name="leader_pro_tra_start_date[]"><span id="leader_pro_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control leader_pro_tra_end_date leader_pro_tra_end_date-' + i + '" type="date" name="leader_pro_tra_end_date[]"><span id="leader_pro_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control leader_pro_expiry leader_pro_expiry-' + i + '" type="date" name="leader_pro_expiry[]"><span id="leaderproexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control leader_pro_upload_certification leader_pro_imgs_' + res_one + ' leader_pro_upload_certification-' + i + '" type="file" name="leader_pro_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqleaderprouploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="leader_pro_imgs' + res_one + '"></div></div></div></div>');
                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="mid_spec_tra_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var mid_spec_tra = [];
                $('.mid_spec_tra_div').removeClass('d-none');
                $(".mid_spec_tra_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                        let res_2 = text.split(' ')[1];
                        res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        res_2 = res_2.substring(0, 2);

                        let res_3 = text.split(' ')[1];
                        res_3 = res_3.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        res_3 = res_3.substring(0, 4)

                        let res_one = res_1 + '_' + res_2 + '_' + res_3;

                        $(".mid_spec_tra_" + res_one).remove();
                    }
                    mid_spec_tra.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".mid_spec_tra_div").empty();
                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();


                    let res_2 = selectedValues[i].split(' ')[1];
                    res_2 = res_2.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    res_2 = res_2.substring(0, 2);

                    let res_3 = selectedValues[i].split(' ')[1];
                    res_3 = res_3.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    res_3 = res_3.substring(0, 4)

                    let res_one = res_1 + '_' + res_2 + '_' + res_3;
                    console.log("res_one", res_one);

                    if (mid_spec_tra.includes(selectedValues[i]) == false) {

                        var user_id = "{{ $sessid }}";
                        var img_text = "mid_spec_imgs";
                        $(".mid_spec_tra_div").append('<div class="mid_spec_tra_' + res_one + ' mid_spec_div_' + selected_text + '"><h6 class="mid_spec_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="midspecnamearr[]" class="mid_spec_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="mid_spec_div row mid_spec_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control mid_spec_institution mid_spec-' + i + '" type="text" name="mid_spec_institution[]"><span id="midspecinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control mid_spec_tra_start_date mid_spec_tra_start_date-' + i + '" type="date" name="mid_spec_tra_start_date[]"><span id="mid_spec_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control mid_spec_tra_end_date mid_spec_tra_end_date-' + i + '" type="date" name="mid_spec_tra_end_date[]"><span id="mid_spec_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control mid_spec_expiry mid_spec_expiry-' + i + '" type="date" name="mid_spec_expiry[]"><span id="midspecexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control mid_spec_upload_certification mid_spec_imgs_' + res_one + ' mid_spec_upload_certification-' + i + '" type="file" name="mid_spec_upload_certification[' + i + '][]" onchange="changetraImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqmidspecuploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="mid_spec_imgs' + res_one + '"></div></div></div></div>');
                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="clinic_skill_core_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var clinic_skill_core = [];
                let selectedIds = [];
                let selectedDataIds = [];


                selectedValues.forEach(function(value) {
                    // Use jQuery to find the <li> element by its text and get the data-value
                    let dataId = $('#clinic_skill_core_data li').filter(function() {
                        return $(this).text() === value;
                    }).data('id');
                    console.log('ggg', dataId);
                    // Add the found dataId to the selectedIds array if it exists
                    if (dataId !== undefined) {
                        selectedIds.push(dataId);
                    }
                });

                $('.clinic_skill_core_div').removeClass('d-none');
                $(".clinic_skill_core_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        // console.log("res_one",res_one);

                        // Find the corresponding dataId for the text from the list
                        let dataId = $('#clinic_skill_core_data li').filter(function() {
                            return $(this).text() === text;
                        }).data('id'); // Get the associated data-id

                        let res_one = res_1 + '_' + dataId;

                        $(".clinic_skill_" + res_one).remove();
                    }
                    clinic_skill_core.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".clinic_skill_core_div").empty();
                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    // Get the corresponding selectedId
                    let selectedId = selectedIds[i];

                    let res_one = res_1 + '_' + selectedId;

                    if (clinic_skill_core.includes(selectedValues[i]) == false) {

                        var user_id = "{{ $sessid }}";
                        var img_text = "clinic_skill_imgs";
                        $(".clinic_skill_core_div").append('<div class="clinic_skill_' + res_one + ' clinic_skill_div_' + selected_text + '"><h6 class="clinic_skill_head_' + selected_text + '">' + selectedValues[i] + '</h6><input type="hidden" name="clinicskillnamearr[]" class="clinic_skill_input_' + selectedValues[i] + '" value="' + selectedValues[i] + '"><div class="clinic_skill_div row clinic_skill_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control clinic_skill_institution clinic_skill-' + i + '" type="text" name="clinic_skill_institution[]"><span id="cliskillinstivalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control clinic_skill_tra_start_date clinic_skill_tra_start_date-' + i + '" type="date" name="clinic_skill_tra_start_date[]"><span id="clinic_skill_tra_start_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End  Date</label><input class="form-control clinic_skill_tra_end_date clinic_skill_tra_end_date-' + i + '" type="date" name="clinic_skill_tra_end_date[]"><span id="clinic_skill_tra_end_datevalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control clinic_skill_expiry clinic_skill_expiry-' + i + '" type="date" name="clinic_skill_expiry[]"><span id="clinicskillexpiryvalid-' + i + '" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control clinic_skill_upload_certification clinic_skill_imgs_' + res_one + ' clinic_skill_upload_certification-' + i + '" type="file" name="clinic_skill_upload_certification[' + i + '][]" onchange="changeImg1(' + user_id + ',' + i + ',\'' + img_text + '\',\'' + res_one + '\')" multiple><span id="reqclinskilluploadvalid-' + i + '" class="reqError text-danger valley"></span><div class="clinic_skill_imgs' + res_one + '"></div></div></div></div>');
                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="mandatory_education"]').on('change', function() {
                let selectedValues = $(this).val();

                console.log("selectedValues", selectedValues);
                //alert($('.js-example-basic-multiple').find(':selected').data('custom-attribute'));
                if (selectedValues.includes("440")) {
                    $('.mandatory_sub_edu_div_1').removeClass('d-none');
                    // $('.license_number_acls').removeClass('d-none');
                } else {
                    $('.mandatory_sub_edu_div_1').addClass('d-none');
                    // $('.license_number_acls').addClass('d-none');
                    $('.core_man_con_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').select2().val(null).trigger('change');
                }
                if (selectedValues.includes("441")) {
                    $('.mandatory_sub_edu_div_2').removeClass('d-none');
                    // $('.license_number_bls').removeClass('d-none');
                } else {
                    $('.mandatory_sub_edu_div_2').addClass('d-none');
                    // $('.license_number_bls').addClass('d-none');
                    $('.mid_spe_mandotry_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').select2().val(null).trigger('change');
                }
                if (selectedValues.includes("442")) {
                    $('.mandatory_sub_edu_div_3').removeClass('d-none');
                    // $('.license_number_cpr').removeClass('d-none');
                } else {
                    $('.mandatory_sub_edu_div_3').addClass('d-none');
                    // $('.license_number_cpr').addClass('d-none');
                    $('.spec_area_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="spec_area_data"]').select2().val(null).trigger('change');
                }

                if (selectedValues.includes("443")) {
                    $('.mandatory_sub_edu_div_4').removeClass('d-none');
                    // $('.license_number_nrp').removeClass('d-none');

                } else {
                    $('.mandatory_sub_edu_div_4').addClass('d-none');
                    // $('.license_number_nrp').addClass('d-none');
                    $('.safety_com_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="safety_com_data"]').select2().val(null).trigger('change');

                }
                if (selectedValues.includes("444")) {
                    $('.mandatory_sub_edu_div_5').removeClass('d-none');
                    // $('.license_number_pals').removeClass('d-none'); 
                } else {
                    $('.mandatory_sub_edu_div_5').addClass('d-none');
                    // $('.license_number_pals').addClass('d-none'); 
                    $('.emerging_topic_div').addClass('d-none');
                    $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').select2().val(null).trigger('change');
                }

            });

            $('.js-example-basic-multiple[data-list-id="core_man_con_data"]').on('change', function() {
                let selectedValues = $(this).val();
                let selectedIds = [];
                let selectedDataIds = [];


                selectedValues.forEach(function(value) {
                    // Use jQuery to find the <li> element by its text and get the data-value
                    let dataId = $('#core_man_con_data li').filter(function() {
                        return $(this).text() === value;
                    }).data('id');

                    // Add the found dataId to the selectedIds array if it exists
                    if (dataId !== undefined) {
                        selectedIds.push(dataId);
                    }
                });
                var core_man_con_data = [];
                $('.core_man_con_data_div').removeClass('d-none');
                $(".core_man_con_data_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        // console.log("res_one",res_one);
                        // Find the corresponding dataId for the text from the list
                        let dataId = $('#core_man_con_data li').filter(function() {
                            return $(this).text() === text;
                        }).data('id'); // Get the associated data-id

                        let res_one = res_1 + '_' + dataId;

                        $(".core_man_" + res_one).remove();
                    }
                    core_man_con_data.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".core_man_con_data_div").empty();

                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_1 = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    let selectedId = selectedIds[i];
                    let res_one = res_1 + '_' + selectedId;

                    if (core_man_con_data.includes(selectedValues[i]) == false) {
                        var user_id = "{{ $sessid }}";
                        var img_text = "core_man_imgs";

                        // $(".core_man_con_data_div").append('<div class="core_man_'+res_one+' core_man_'+selected_text+'"><h6 class="core_man_head_'+selected_text+'">'+selectedValues[i]+'</h6><input type="hidden" name="coremanarr[]" class="coreman_input_'+selectedValues[i]+'" value="'+selectedValues[i]+'"><div class="core_man_div row core_man_institution"><div class="form-group col-md-12"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control core_man_institution core_man_institution-'+i+'" type="text" name="core_man_institution[]"><span id="coreinstitutionvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Start Date</label><input class="form-control coreman_start_date coreman_start_date-'+i+'" type="date" name="coreman_start_date[]"><span id="coreman_start_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">End Date</label><input class="form-control coreman_end_date coreman_end_date-'+i+'" type="date" name="coreman_end_date[]"><span id="coreman_end_datevalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control well_expiry well_expiry-'+i+'" type="date" name="well_expiry[]"><span id="wellexpiryvalid-'+i+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control well_upload_certification well_imgs_'+res_one+' well_upload_certification-'+i+'" type="file" name="well_upload_certification['+i+'][]" onchange="changeImg1('+user_id+','+i+',\''+img_text+'\',\''+res_one+'\')" multiple><span id="reqwelluploadvalid-'+i+'" class="reqError text-danger valley"></span><div class="well_imgs'+res_one+'"></div></div></div></div>');
                        $(".core_man_con_data_div").append(`
              <div class="core_man_${res_one} core_man_${selected_text}">
                  <h6 class="core_man_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="coremanarr[]" class="coreman_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="core_man_div row core_man_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control core_man_institution core_man_institution-${i}" type="text" name="core_man_institution[]">
                          <span id="coreinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control coreman_start_date coreman_start_date-${i}" type="date" name="coreman_start_date[]">
                          <span id="coreman_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control coreman_end_date coreman_end_date-${i}" type="date" name="coreman_end_date[]">
                          <span id="coreman_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control coreman_status coreman_status-${i}" name="coreman_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="coreman_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control core_man_expiry core_man_expiry-${i}" type="date" name="core_man_expiry[]">
                          <span id="coremanexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control coreman_upload_certification core_man_imgs_${res_one} coreman_upload_certification-${i}" 
                                type="file" name="coreman_upload_certification[${i}][]" 
                                onchange="changeImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqcoremanuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="core_man_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);
                    }
                }


            });

            $('.js-example-basic-multiple[data-list-id="mid_spe_mandotry_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var mid_spe_mandotry_data = [];
                $('.mid_spe_mandotry_div').removeClass('d-none');
                $(".mid_spe_mandotry_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        console.log("res_one", res_one);
                        $(".mid_spe_" + res_one).remove();
                    }
                    mid_spe_mandotry_data.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".mid_spe_mandotry_div").empty();

                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    if (mid_spe_mandotry_data.includes(selectedValues[i]) == false) {
                        var user_id = "{{ $sessid }}";
                        var img_text = "mid_spe_imgs";
                        $(".mid_spe_mandotry_div").append(`
              <div class="mid_spe_${res_one} mid_spe_${selected_text}">
                  <h6 class="mid_spe_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="midspearr[]" class="midspe_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="mid_spe_div row mid_spe_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control mid_spe_institution mid_spe_institution-${i}" type="text" name="mid_spe_institution[]">
                          <span id="midspeinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control mid_spe_start_date mid_spe_start_date-${i}" type="date" name="mid_spe_start_date[]">
                          <span id="mid_spe_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control mid_spe_end_date coreman_end_date-${i}" type="date" name="mid_spe_end_date[]">
                          <span id="mid_spe_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control mid_spe_status mid_spe_status-${i}" name="mid_spe_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="mid_spe_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control mid_spe_expiry mid_spe_expiry-${i}" type="date" name="mid_spe_expiry[]">
                          <span id="midspeexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control midspe_upload_certification mid_spe_imgs_${res_one} midspe_upload_certification-${i}" 
                                type="file" name="midspe_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqmidspeuploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="mid_spe_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);
                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="spec_area_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var spec_area_data = [];

                // Hide and clear unnecessary elements
                $('.spec_area_div').removeClass('d-none');
                $(".spec_area_div h6").each(function() {
                    var text = $(this).text();
                    if (!selectedValues.includes(text)) {
                        let res = text.split(' ')[0];
                        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        $(".spec_area_" + res_one).remove();
                    }
                    spec_area_data.push(text);
                });

                console.log("selectedValues", selectedValues);

                // Accumulate HTML in a variable
                var newContent = "";

                // Loop through selected values and generate the necessary fields
                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();

                    console.log("res_one", res_one);

                    if (spec_area_data.indexOf(selectedValues[i]) === -1) {
                        var user_id = "{{ $sessid }}";
                        var img_text = "spec_area_imgs";

                        // Append HTML content for this selection
                        newContent += `
                <div class="spec_area_${res_one} spec_area_${selected_text}">
                    <h6 class="mid_spe_head_${selected_text}">${selectedValues[i]}</h6>
                    <input type="hidden" name="specareaarr[]" class="spec_area_input_${selectedValues[i]}" value="${selectedValues[i]}">
                    
                    <div class="spec_area_div row spec_area_institution">
                        <!-- Institution/Regulating Body -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Institution/Regulating Body</label>
                            <input class="form-control spec_area_institution spec_area_institution-${i}" type="text" name="spec_area_institution[]">
                            <span id="specareainstitutionvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Start Date</label>
                            <input class="form-control spec_area_start_date spec_area_start_date-${i}" type="date" name="spec_area_start_date[]">
                            <span id="spec_area_start_datevalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- End Date -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">End Date</label>
                            <input class="form-control spec_area_end_date spec_area_end_date-${i}" type="date" name="spec_area_end_date[]">
                            <span id="spec_area_end_datevalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Status</label>
                            <select class="form-control spec_area_status spec_area_status-${i}" name="spec_area_status[]">
                                <option value="Completed">Completed</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <span id="spec_area_statusvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Expiry -->
                        <div class="form-group col-md-6">
                            <label class="form-label" for="input-1">Expiry</label>
                            <input class="form-control spec_area_expiry spec_area_expiry-${i}" type="date" name="spec_area_expiry[]">
                            <span id="specareaexpiryvalid-${i}" class="reqError text-danger valley"></span>
                        </div>

                        <!-- Upload Certificate/Licence -->
                        <div class="form-group col-md-12">
                            <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                            <input class="form-control specarea__upload_certification spec_area_imgs_${res_one} specarea_upload_certification-${i}" 
                                type="file" name="specarea_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                            <span id="reqspecarea uploadvalid-${i}" class="reqError text-danger valley"></span>
                            <div class="spec_area_imgs${res_one}"></div>
                        </div>
                    </div>
                </div>`;
                    }
                }

                // Append all new content at once
                $(".spec_area_div").append(newContent);
            });


            $('.js-example-basic-multiple[data-list-id="safety_com_data"]').on('change', function() {
                let selectedValues = $(this).val();
                var safety_com_data = [];
                $('.safety_com_div').removeClass('d-none');
                $(".safety_com_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        console.log("res_one", res_one);
                        $(".safety_com_" + res_one).remove();
                    }
                    safety_com_data.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".safety_com_div").empty();

                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    console.log("res_one", res_one);

                    if (safety_com_data.includes(selectedValues[i]) == false) {
                        var user_id = "{{ $sessid }}";
                        var img_text = "safety_com_imgs";
                        $(".safety_com_div").append(`
              <div class="safety_com_${res_one} safety_com_${selected_text}">
                  <h6 class="safety_com_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="safetycomaarr[]" class="safety_com_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="safety_com_div row safety_com_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control safety_com_institution safety_com_institution-${i}" type="text" name="safety_com_institution[]">
                          <span id="safetycominstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control safety_com_start_date safety_com_start_date-${i}" type="date" name="safety_com_start_date[]">
                          <span id="safety_com_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control safety_com_end_date safety_com_end_date-${i}" type="date" name="safety_com_end_date[]">
                          <span id="safety_com_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control safety_com_status safety_com_status-${i}" name="safety_com_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="safety_com_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control safety_com_expiry safety_com_expiry-${i}" type="date" name="safety_com_expiry[]">
                          <span id="safetycomexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control safetycome_upload_certification safety_com_imgs_${res_one} safetycome_upload_certification-${i}" 
                                type="file" name="safetycome_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqsafetycome uploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="safety_com_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);


                    }
                }
            });

            $('.js-example-basic-multiple[data-list-id="emerging_topic_data"]').on('change', function() {
                let selectedValues = $(this).val();
                //     let selectedIds = [];
                //      let selectedDataIds = [];


                //    selectedValues.forEach(function(value) {
                //         // Use jQuery to find the <li> element by its text and get the data-value
                //         let dataId = $('#emerging_topic_data li').filter(function() {
                //             return $(this).text() === value;
                //         }).data('id');

                //         // Add the found dataId to the selectedIds array if it exists
                //         if (dataId !== undefined) {
                //             selectedIds.push(dataId);
                //         }
                //     });

                var emerging_topic_data = [];
                $('.emerging_topic_div').removeClass('d-none');
                $(".emerging_topic_div h6").each(function() {
                    var text = $(this).text();
                    if (selectedValues.includes(text) == false) {
                        let res = text.split(' ')[0];
                        let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                        // Find the corresponding dataId for the text from the list
                        // let dataId = $('#emerging_topic_data li').filter(function() {
                        //     return $(this).text() === text;
                        // }).data('id');  // Get the associated data-id

                        // let res_one = res_1 + '_' +dataId;

                        $(".eme_topic_" + res_one).remove();
                    }
                    emerging_topic_data.push(text);
                });
                console.log("selectedValues", selectedValues);

                // $(".emerging_topic_div").empty();

                for (var i = 0; i < selectedValues.length; i++) {
                    var selected_text = selectedValues[i].replace(/ .*/, '').replace(/[^\w\s]/gi, '').toLowerCase();
                    let res = selectedValues[i].split(' ')[0];
                    let res_one = res.replace(/[\s~`!@#$%^&*(){}\[\];:"'<,.>?\/\\|_+=-]/g, '').toLowerCase();
                    //   let selectedId = selectedIds[i];

                    //   let res_one = res_1+'_'+selectedId;

                    if (emerging_topic_data.includes(selectedValues[i]) == false) {
                        var user_id = "{{ $sessid }}";
                        var img_text = "eme_topic_imgs";
                        $(".emerging_topic_div").append(`
              <div class="eme_topic_${res_one} eme_topic_${selected_text}">
                  <h6 class="eme_topic_head_${selected_text}">${selectedValues[i]}</h6>
                  <input type="hidden" name="emetopicarr[]" class="eme_topic_input_${selectedValues[i]}" value="${selectedValues[i]}">
                  
                  <div class="eme_topic_div row eme_topic_institution">
                      <!-- Institution/Regulating Body -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Institution/Regulating Body</label>
                          <input class="form-control eme_topic_institution eme_topic_institution-${i}" type="text" name="eme_topic_institution[]">
                          <span id="emetopicinstitutionvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Start Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Start Date</label>
                          <input class="form-control eme_topic_start_date eme_topic_start_date-${i}" type="date" name="eme_topic_start_date[]">
                          <span id="eme_topic_start_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- End Date -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">End Date</label>
                          <input class="form-control eme_topic_end_date eme_topic_end_date-${i}" type="date" name="eme_topic_end_date[]">
                          <span id="eme_topic_end_datevalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Status -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Status</label>
                          <select class="form-control eme_topic_status eme_topic_status-${i}" name="eme_topic_status[]">
                              <option value="Completed">Completed</option>
                              <option value="Ongoing">Ongoing</option>
                              <option value="Pending">Pending</option>
                          </select>
                          <span id="eme_topic_statusvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Expiry -->
                      <div class="form-group col-md-6">
                          <label class="form-label" for="input-1">Expiry</label>
                          <input class="form-control eme_topic_expiry eme_topic_expiry-${i}" type="date" name="eme_topic_expiry[]">
                          <span id="emetopicexpiryvalid-${i}" class="reqError text-danger valley"></span>
                      </div>

                      <!-- Upload Certificate/Licence -->
                      <div class="form-group col-md-12">
                          <label class="form-label" for="input-1">Upload Certificate/Licence</label>
                          <input class="form-control emetopic_upload_certification eme_topic_imgs_${res_one} emetopic_upload_certification-${i}" 
                                type="file" name="emetopic_upload_certification[${i}][]" 
                                onchange="changetraImg1(${user_id},${i},'${img_text}','${res_one}')" multiple>
                          <span id="reqemetopic uploadvalid-${i}" class="reqError text-danger valley"></span>
                          <div class="eme_topic_imgs${res_one}"></div>
                      </div>
                  </div>
              </div>
          `);


                    }
                }
            });

        });
    </script>


    <script type="text/javascript">
        var ano_img_txt = "other_tran_img";

        function add_listtraining() {
            var training_div_count = $(".another_com_tra_div").length;
            console.log("training_div_count", training_div_count);
            training_div_count++;
            var user_id = "{{ $sessid }}";
            // var ano_img_txt = "other_tran_img";
            var name = 'tran' + '_' + training_div_count;
            // $(".another_com_training").append('<div class="training_div training_div_'+training_div_count+' row another_com_tra_div"><div class="form-group col-md-6"><label class="form-label" for="input-1">Training '+training_div_count+'</label><input class="form-control additional_tra_field additional_tra_field-'+training_div_count+'" type="text" name="training[]"><span id="reqtraname-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control institution institution-'+training_div_count+'" type="text" name="institution[]"><span id="reqinstitution-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tra_start_date tra_start_date-'+training_div_count+'" type="date" name="tra_start_date[]"><span id="reqtrastartdate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End Date</label><input class="form-control tra_end_date tra_end_date-'+training_div_count+'" type="date" name="tra_end_date[]"><span id="reqtraenddate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tra_expiry tra_expiry-'+training_div_count+'" type="date" name="tra_expiry[]"><span id="reqtra_expiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control '+name+' additional_certifications-'+training_div_count+'" type="file" name="certificate_upload_certification['+training_div_count+'][]" onchange="changeAnoImg('+user_id+','+training_div_count+','+ano_img_txt+','+name+')" multiple></div><div class="'+ano_img_txt+training_div_count+'"></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_training('+training_div_count+')">- Delete Training</a></div></div></div>');
            $(".another_com_training").append(`
        <div class="training_div training_div_${training_div_count} row another_com_tra_div">
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Training ${training_div_count}</label>
                <input class="form-control additional_tra_field additional_tra_field-${training_div_count}" type="text" name="training[]">
                <span id="reqtraname-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Institution/Regulating Body</label>
                <input class="form-control institution institution-${training_div_count}" type="text" name="institution[]">
                <span id="reqinstitution-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Training Start Date</label>
                <input class="form-control tra_start_date tra_start_date-${training_div_count}" type="date" name="tra_start_date[]">
                <span id="reqtrastartdate-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Training End Date</label>
                <input class="form-control tra_end_date tra_end_date-${training_div_count}" type="date" name="tra_end_date[]">
                <span id="reqtraenddate-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Expiry</label>
                <input class="form-control tra_expiry tra_expiry-${training_div_count}" type="date" name="tra_expiry[]">
                <span id="reqtra_expiry-${training_div_count}" class="reqError text-danger valley"></span>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="input-1">Upload Certificate</label>
                <input class="form-control other_tran_img_${name} additional_certifications-${training_div_count}" 
                       type="file" 
                       name="certificate_upload_certification[${training_div_count}][]" 
                       onchange="changeAnoImg(${user_id}, ${training_div_count}, '${ano_img_txt}', '${name}')" 
                       multiple>
                <div class="other_tran_img${name} mt-2"></div>
            </div>
            
            <div class="col-md-12">
                <div class="add_new_certification_div">
                    <a style="cursor: pointer;" onclick="delete_training(${training_div_count})">- Delete Training</a>
                </div>
            </div>
        </div>
    `);
        }

        function delete_training(i, user_id, training_id) {
            $(".training_div_" + i).remove();
        }

        // function delete_training(i,user_id,training_id){ 
        //   $.ajax({
        //     type: "post",
        //     url: "{{ route('nurse.deleteTraining') }}",
        //     data: {user_id:user_id,training_id:training_id,_token:'{{ csrf_token() }}'},
        //     cache: false,
        //     success: function(data){
        //         if(data == 1){
        //         $(".another_com_training"+i).remove();
        //         }

        //     }
        //   });
        // }

        // for education

        // console.log("training_div_count",training_div_count);
        function add_listeduction() {
            var education_div_count = $(".another_edu_div").length;
            education_div_count++;
            var user_id = "{{ $sessid }}";
            var ano_edu_img_txt = 'ano_education_imgs'
            var name = 'edu' + '_' + education_div_count;
            // $(".another_education").append('<div class="training_div training_div_'+training_div_count+' row another_com_tra_div"><div class="form-group col-md-6"><label class="form-label" for="input-1">Training '+training_div_count+'</label><input class="form-control additional_tra_field additional_tra_field-'+training_div_count+'" type="text" name="training[]"><span id="reqtraname-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Institution/Regulating Body</label><input class="form-control institution institution-'+training_div_count+'" type="text" name="institution[]"><span id="reqinstitution-'+training_div_count+'" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training Start Date</label><input class="form-control tra_start_date tra_start_date-'+training_div_count+'" type="date" name="tra_start_date[]"><span id="reqtrastartdate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Training End Date</label><input class="form-control tra_end_date tra_end_date-'+training_div_count+'" type="date" name="tra_end_date[]"><span id="reqtraenddate-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Expiry</label><input class="form-control tra_expiry tra_expiry-'+training_div_count+'" type="date" name="tra_expiry[]"><span id="reqtra_expiry-{{ $i }}" class="reqError text-danger valley"></span></div><div class="form-group col-md-6"><label class="form-label" for="input-1">Upload Certificate</label><input class="form-control additional_certifications-'+training_div_count+'" type="file" name="certificate_upload_certification['+training_div_count+'][]" onchange="changeImg2('+user_id+','+training_div_count+')" multiple></div><div class="col-md-12"><div class="add_new_certification_div mb-3 mt-3"><a style="cursor: pointer;" onclick="delete_training('+training_div_count+')">- Delete certification/Licence</a></div></div></div>');
            $(".another_education").append(`
    <div class="eduction_div eduction_div_${education_div_count} row another_edu_div">
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Course/Workshop ${education_div_count}</label>
            <input class="form-control additional_course_field additional_course_field-${education_div_count}" 
                   type="text" name="education[]">
            <span id="reqeduname-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Institution/Regulating Body</label>
            <input class="form-control institution institution-${education_div_count}" 
                   type="text" name="institution[]">
            <span id="reqinstitution-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Start Date</label>
            <input class="form-control start_date start_date-${education_div_count}" 
                   type="date" name="start_date[]">
            <span id="reqstartdate-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">End Date</label>
            <input class="form-control end_date end_date-${education_div_count}" 
                   type="date" name="end_date[]">
            <span id="reqenddate-${education_div_count}" class="reqError text-danger valley"></span>
        </div>

        <!-- Status -->
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Status</label>
            <select class="form-control edu_status edu_status-${education_div_count}" name="edu_status[]">
                <option value="Completed">Completed</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Pending">Pending</option>
            </select>
            <span id="edu_statusvalid-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Expiry</label>
            <input class="form-control edu_expiry edu_expiry-${education_div_count}" 
                   type="date" name="edu_expiry[]">
            <span id="reqedu_expiry-${education_div_count}" class="reqError text-danger valley"></span>
        </div>
        
        <div class="form-group col-md-6">
            <label class="form-label" for="input-1">Upload Certificate/Licence</label>
            <input class="form-control ano_education_imgs_${name} additional_cour_certifications-${education_div_count}" 
                   type="file" name="cour_certificate_upload_certification[${education_div_count}][]" 
                   onchange="changeAnoImg(${user_id}, ${education_div_count},'${ano_edu_img_txt}','${name}')" multiple>
                   <div class="ano_education_imgs${name}" ></div>
        </div>
        
        <div class="col-md-12">
            <div class="add_new_certification_div">
                <a style="cursor: pointer;" onclick="delete_edu(${education_div_count})">
                    - Delete Continuing Education
                </a>
            </div>
        </div>
        
    </div>
`);
        }

        function delete_edu(i, user_id, education_id) {
            $(".eduction_div_" + i).remove();
        }


        function changetraImg1(user_id, i, field_name, cat_name) {

            var files = $('.' + field_name + '_' + cat_name)[0].files;

            var form_data = "";

            form_data = new FormData();

            for (var i = 0; i < files.length; i++) {
                form_data.append("upload_images[]", files[i], files[i]['name']);
            }

            form_data.append("user_id", user_id);
            form_data.append("cat_name", cat_name);
            form_data.append("field_name", field_name);
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                type: "post",
                url: "{{ route('admin.uploadmantraImgs1') }}",
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
                        htmlData += '<div class="trans_img trans_img-' + (i + 1) + ' trans_img' + field_name + cat_name + i + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteImg1(' + i + ',' + user_id + ',\'' + image_array[i] + '\',\'' + cat_name + '\',\'' + img_text + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
                    }
                    $("." + field_name + cat_name).html(htmlData);


                }
            });

        }

        // change image for another training and education
        function changeAnoImg(user_id, i, field_name, cat_name) {
            var files = $('.' + field_name + '_' + cat_name)[0].files;

            var form_data = "";

            form_data = new FormData();

            for (var i = 0; i < files.length; i++) {
                form_data.append("upload_images[]", files[i], files[i]['name']);
            }

            form_data.append("user_id", user_id);
            form_data.append("cat_name", cat_name);
            form_data.append("field_name", field_name);
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                type: "post",
                url: "{{ route('admin.uploadAnotherImgs') }}",
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
                        console.log("img_name", 'deleteanoImg(' + (i + 1) + ',' + user_id + ',"' + img_name + '")');
                        htmlData += '<div class="trans_img edu_img-' + (i + 1) + ' edu_img' + field_name + 'tran_' + (i) + '"><a href="{{ url("/public") }}/uploads/education_degree/' + img_name + '" target="_blank"><i class="fa fa-file" aria-hidden="true"></i>' + image_array[i] + '</a><div class="close_btn close_btn-' + i + '" onclick="deleteanoImg1(' + i + ',' + user_id + ',\'' + image_array[i] + '\',\'' + cat_name + '\',\'' + img_text + '\')" style="cursor: pointer;"><i class="fa fa-close" aria-hidden="true"></i></div></div>';
                    }
                    $("." + field_name + cat_name).html(htmlData);
                }
            });

        }
    </script>