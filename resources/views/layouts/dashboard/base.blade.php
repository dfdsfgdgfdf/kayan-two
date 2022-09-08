<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.dashboard.head')
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->

        @include('layouts.dashboard.topbar')

        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.dashboard.leftsidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    @yield('content')
                    <!-- end row -->

                </div> <!-- container-fluid -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.dashboard.footer')
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>


        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ URL::asset('assets/js/vendor.min.js') }}"></script>

    <!-- knob plugin -->
    <script src="{{ URL::asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ URL::asset('assets/libs/morris-js/morris.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/raphael/raphael.min.js') }}"></script>

    <!-- Dashboard init js-->
    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>

    <!-- dropify js -->
    <script src="{{ URL::asset('assets/libs/dropify/dropify.min.js') }}"></script>

    <!-- form-upload init -->
    <script src="{{ URL::asset('assets/js/pages/form-fileupload.init.js') }}"></script>

    <!-- Responsive Table js -->
    <script src="{{ URL::asset('assets/libs/rwd-table/rwd-table.min.js') }}"></script>

    <!-- Init js -->
    <script src="{{ URL::asset('assets/js/pages/responsive-table.init.js') }}"></script>

    <!-- Toastr js -->
    <script src="{{ URL::asset('assets/libs/toastr/toastr.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/toastr.init.js') }}"></script>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @livewireScripts
    @stack('scripts')

    

    <script>
        document.addEventListener('livewire:load', function() {

        });

        window.addEventListener('hide-form', () => {
            $('#addModal').modal('hide');
            $('#updateModal').modal('hide');
        })
    </script>

</body>

</html>
