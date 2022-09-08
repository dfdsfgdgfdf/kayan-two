<html>

<head>
    @include('layouts.site.head')
    @stack('styles')
    <style>
        .loading {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, .5);
        }

        .loading-wheel {
            width: 20px;
            height: 20px;
            margin-top: -40px;
            margin-left: -40px;

            position: absolute;
            top: 50%;
            left: 50%;

            border-width: 30px;
            border-radius: 50%;
            -webkit-animation: spin 1s linear infinite;
        }

        .style-2 .loading-wheel {
            border-style: double;
            border-color: rgb(4, 1, 1) transparent;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0);
            }

            100% {
                -webkit-transform: rotate(-360deg);
            }
        }

    </style>
</head>
<body style="direction:ltr ;">
    @include('layouts.site.leftsidebar')
    <div class="main main-sec">
        <!-- start first bar -->
        @include('layouts.site.topbar')

        <!-- end first bar -->
        <div class="card-home py-4">
            <div class="row">

            </div>
            @yield('content')
        </div>

        @include('layouts.site.footer')

        @livewireScripts
        @stack('scripts')
    </div>
</body>

</html>
