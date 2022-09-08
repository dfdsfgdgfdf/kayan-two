<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.dashboard.head')
</head>

<body class="authentication-bg">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a href="#"><img src="{{ URL::asset('assets1/images/Capture1.png') }}"
                                class="logo-image"></a>

                    </div>
                    <div class="card">

                        <div class="card-body p-4 mt-3">

                            <form action="{{ route('doctor.check') }}" method="POST">
                                @csrf

                                @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif

                                <div class="form-group mb-3">
                                    <label for="emailaddress">phone</label>
                                    <input name="phone" class="form-control" type="text" id="emailaddress" required=""
                                        placeholder="Enter your phone number">
                                    <span class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">password</label>
                                    <input name="password" class="form-control" type="password" required=""
                                        id="password" placeholder="Enter your password">
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember_me" class="custom-control-input" id="checkbox-signin">
                                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button style="background-color: #eb5534;" class="btn btn-primary btn-block"
                                        type="submit">Login</button>
                                </div>

                                <div class="form-group mb-0 mt-3 text-center">
                                    <a onclick="forgetPassword()">forget password</a>
                                </div>
                                <div id="forgetDiv" class="form-group mb-0 mt-3 text-center" style="display: none;">
                                    <a style="color: red" href="https://api.whatsapp.com/send?phone=01094490330">please send whatsapp message to: 01094490330</a>
                                </div>


                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <!-- Vendor js -->
    <script src="{{ URL::asset('assets/js/vendor.min.js') }}"></script>
    <script>
        function forgetPassword() {
            document.getElementById('forgetDiv').style.display="block";
        }
    </script>


    <!-- App js -->
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>

</body>

</html>
