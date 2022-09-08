@extends('layouts.site.base')
@section('content')
    <!-- start image sec -->
    <div class="image-sec-home ">
        <img src="{{ URL::asset('assets1/images/Group 599.png') }}" style="width: 100%;">
    </div>
    <!-- end image sec -->
    
    <!-- start card-home sec -->
    <div class="card-home py-4">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 mt-2">
                <div class="card">
                    <div class="row">
                        <div class="col">
                            <p class="title">New Reservation</p>

                        </div>
                        <div class="col">
                            <p class="show-more"><a href="{{ route('doctor.Examination.list', 'new') }}">Show More</a>
                            </p>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="media">
                                <img src="{{ URL::asset('assets1/images/Group 600.png') }}" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $new }}</h5>
                                    <p>Patient</p>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <img src="{{ URL::asset('assets1/images/Mask Group 13.png') }}" class="rate-img">

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mt-2">
                <div class="card">
                    <div class="row">
                        <div class="col">
                            <p class="title">Re- Reservation</p>

                        </div>
                        <div class="col">
                            <p class="show-more"><a href="{{ route('doctor.Examination.list', 'resumption') }}">Show
                                    More</a></p>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="media">
                                <img src="{{ URL::asset('assets1/images/Group 601.png') }}" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $re }}</h5>
                                    <p>Patient</p>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <img src="{{ URL::asset('assets1/images/Mask Group 14.png') }}" class="rate-img">

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mt-2">
                <div class="card">
                    <div class="row">
                        <div class="col">
                            <p class="title">Online Reservation</p>

                        </div>
                        <div class="col">
                            <p class="show-more"><a>Show More</a></p>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="media">
                                <img src="{{ URL::asset('assets1/images/Group 602.png') }}" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">0</h5>
                                    <p>Patient</p>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <img src="{{ URL::asset('assets1/images/Mask Group 13.png') }}" class="rate-img">

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="progress-bar1 mt-4">
            <div class="container  ">
                <div class="row mt-3 ">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 mt-2 container-7  ">

                        <h4><i class="fas fa-users" style="padding-right: 10px;"></i>percentage of patient for today:</h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $today_percantage }}"
                                aria-valuemin="0" aria-valuemax="100" style="width:{{ $today_percantage }}%">
                                {{ $today_percantage }}%
                            </div>
                        </div>



                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1 mt-3"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3 container-7  ">

                        <h4><i class="fas fa-users" style="padding-right: 10px;"></i>percentage of patient this month:
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $last_mounth_percantage }}"
                                aria-valuemin="0" aria-valuemax="100" style="width:{{ $last_mounth_percantage }}%">
                                {{ $last_mounth_percantage }}%
                            </div>
                        </div>



                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 mt-3 container-7  ">

                        <h4><i class="fas fa-users" style="padding-right: 10px;"></i>Female to male percentage for
                            this month:</h4>
                        <div class="row">
                            <div class="col">
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $female_percanteg }}"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{ $female_percanteg }}%">
                                        {{ $female_percanteg }}%
                                    </div>

                                </div>
                                <p>Female</p>

                            </div>
                            <div class="col">
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $male_percanteg }}"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{ $male_percanteg }}%">
                                        {{ $male_percanteg }}%
                                    </div>

                                </div>
                                <p>male</p>

                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1 mt-3"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3 container-7  ">

                        <h4><i class="fas fa-users" style="padding-right: 10px;"></i>percentage of patients reserved
                            last week:</h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $last_week_percantage }}"
                                aria-valuemin="0" aria-valuemax="100" style="width:{{ $last_week_percantage }}%">
                                {{ $last_week_percantage }}%
                            </div>
                        </div>



                    </div>

                </div>

            </div>
        </div>
    </div>

    </div>
    <!-- end card-home sec -->
@endsection
