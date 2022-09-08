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
                            <a href="#"><img src="{{ URL::asset('assets1/images/Capture1.png') }}" class="logo-image" ></a>
                            
                        </div>
                        <div class="card">

                            <div class="card-body p-4 mt-3">

                                <form action="{{ route('doctor.forget.password') }}" method="POST">
                                    @csrf

                                    @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                       {{ Session::get('fail') }}
                                    </div>
                                    @endif

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Enter Your Email</label>
                                        <input name="email" class="form-control" type="text" id="emailaddress" required="" placeholder="Enter Your Email">
                                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                    </div>


                                    <div class="form-group mb-0 text-center">
                                        <button style="background-color: #eb5534;" class="btn btn-primary btn-block" type="submit">Send Email</button>
                                    </div>

                                    <div class="form-group mb-0 mt-3 text-center">
                                        <a href="{{ route('doctor.login') }}" style="background-color: #eb5534;" class="btn btn-primary btn-block" type="submit">Back to Login</a>
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
        <script src="{{ URL::asset( 'assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ URL::asset( 'assets/js/app.min.js') }}"></script>
        
    </body>
</html>