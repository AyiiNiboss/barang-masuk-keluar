<script src="{{ asset('./assets/vendor/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('./assets/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>

<!-- js for this page only -->
<script src="{{ asset('./assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('./assets/js/page/index.js') }}"></script>
<!-- ======= -->
<script src="{{ asset('./assets/js/main.js') }}"></script>
<script>
    Main.init()
</script>
<script src="{{ asset('./assets/js/login.js') }}"></script>

    {{-- script menu user --}}
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
        var table = $('#example').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } );
    } );
    </script>
