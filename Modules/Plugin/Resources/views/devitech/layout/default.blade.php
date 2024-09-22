@extends('plugin::devitech.master')
@section('content')
<div class="content-wrapper">
    {!! @$content !!}
</div>
@endsection

<?php if (!empty($routeRemoveItems) || !empty($routeUpdateStatusItems)): ?>
<script>
    let routeRemoveItems = "{{ $routeRemoveItems }}";
    let routeUpdateStatusItems = "{{ $routeUpdateStatusItems }}";
</script>
<?php endif;?>
@push("js")

<script>
    $.widget.bridge("uibutton", $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="{{ assets }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ assets }}plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ assets }}plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
{{-- <script src="{{ assets }}plugins/jqvmap/jquery.vmap.min.js"></script> --}}
{{-- <script src="{{ assets }}plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{ assets }}plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ assets }}plugins/moment/moment.min.js"></script>
<script src="{{ assets }}plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="{{ assets }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="{{ assets }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ assets }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ assets }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ assets }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ assets }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ assets }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
{{-- <script src="{{ assets }}plugins/jszip/jszip.min.js"></script> --}}
{{-- <script src="{{ assets }}plugins/pdfmake/pdfmake.min.js"></script> --}}
<script src="{{ assets }}plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ assets }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ assets }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ assets }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


 <!-- iv-select -->
 <script src="{{ assets }}plugins/iv-select/iv-select.js"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="{{ assets }}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 <!-- Summernote -->
 <script src="{{ assets }}plugins/summernote/summernote-bs4.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="{{ assets }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 {{-- <script src="{{ assets }}dist/js/adminlte.js"></script> --}}
 <!-- AdminLTE for demo purposes -->
 {{-- <script src="{{ assets }}dist/js/demo.js"></script> --}}
 <script>
    $(function () {
        $("#example1")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
            paging: false,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: false,
            autoWidth: false,
            responsive: false
        });
    });
</script>
@endpush
