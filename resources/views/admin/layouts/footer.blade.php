 <!--  Customizer -->
    <!--  Import Js Files -->
    <script src="{{ asset('assets/admin/dist/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/libs/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
     <!-- DataTables JavaScript -->
     <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
     <!-- Initialize DataTables -->
    <!--  core files -->
    <script src="{{ asset('assets/admin/dist/js/app.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/app.init.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/app-style-switcher.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/sidebarmenu.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/custom.js')}}"></script>
    <!--  current page js files -->
    <script src="{{ asset('assets/admin/dist/libs/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/admin/dist/js/dashboard.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    //  $(document).ready(function() {
    //        $('.table').DataTable({
    //            searching: true,
    //            lengthChange: false,
    //            paging: true,
    //            info: false,

    //        });
    //    });   
    $(document).ready(function() {
    var table = $('.table').DataTable({
        searching: true,
        lengthChange: true,
        paging: true,
        info: false,
        buttons: ["csv", "excel", "pdf", "print", "colvis"],
        // dom: '<"top"f>rt<"bottom"lp><"clear">',
    });

    // Position buttons right after the .dataTables_length div
    table.buttons().container().appendTo('.dataTables_wrapper').insertAfter('.dataTables_length');

    $('.dataTables_wrapper .dt-buttons').addClass('my-custom-class');
   })
   </script>
   