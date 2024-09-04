<script src="{{ asset('template/administrator/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('template/administrator/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('template/administrator/assets/js/core/bootstrap.min.js') }}"></script>
{{-- ini --}}
<script src="{{ asset('template/administrator/assets/js/plugin/moment/moment.min.js') }}"></script>
<!-- jQuery Scrollbar -->
<script src="{{ asset('template/administrator/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/chart.js/chart.min.js') }}"></script> --}}

<!-- jQuery Sparkline -->
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script> --}}

<!-- Chart Circle -->
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/chart-circle/circles.min.js') }}"></script> --}}

<!-- Datatables -->
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/datatables/datatables.min.js') }}"></script> --}}

<!-- Bootstrap Notify -->
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}

<!-- jQuery Vector Maps -->
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/jsvectormap/world.js') }}"></script> --}}

<!-- Sweet Alert -->
{{-- <script src="{{ asset('template/administrator/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script> --}}

<!-- Kaiadmin JS -->
<script src="{{ asset('template/administrator/assets/js/kaiadmin.min.js') }}"></script>

@stack('script')
<script>
    $(document).ready(function () {
        document.getElementById('logout').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('formLogout').submit();
        });
    });
</script>