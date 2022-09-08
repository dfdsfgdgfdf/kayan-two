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
                            {{-- <p class="mb-4">{{ __('dashboard.Kayan Dashboard') }}</p> --}}
                        </div>
                        <div class="card">

                            <div class="card-body p-4 mt-3">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">{{ __('dashboard.Kayan Dashboard') }}</h4>
                                </div>

                                <form action="{{ route('dashboard.check') }}" method="POST">
                                    @csrf

                                    @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                       {{ Session::get('fail') }}
                                    </div>
                                    @endif

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">{{ __('dashboard.phone') }}</label>
                                        <input name="phone" class="form-control" type="text" id="emailaddress" required="" placeholder="Enter your phone number">
                                        <span class="text-danger">@error('phone'){{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">{{ __('dashboard.password') }}</label>
                                        <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember_me" class="custom-control-input" id="checkbox-signin" >
                                            <label class="custom-control-label" for="checkbox-signin">{{ __('dashboard.remember_me') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit">{{ __('dashboard.login') }} </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        {{-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="pages-recoverpw.html" class="text-muted ml-1"><i class="fa fa-lock mr-1"></i>{{ __('dashboard.ForgotPassword') }}</a></p>
                                <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"> <p>العربية</p> </a> 
                                <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"> <p>Engilsh</p> </a>
                            </div> 
                        </div> --}}
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