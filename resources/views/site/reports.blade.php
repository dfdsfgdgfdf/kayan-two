@extends('layouts.site.base')
@section('content')
    <div class="options-sec-1  py-4">
        <div class="container container-1" style="width: 85%;">
            <div class="row mt-3 options-row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  options-col">
                    <img src="{{ URL::asset('assets1/images/Group 165.png') }}" class="options-img">
                    <div class="card" style="width: 100%;background: #3d5ca9;">
                        <div class="card-body">
                            <h3><a href="{{ route('doctor.reports.data.table') }}">Patient Chart</a></h3>

                        </div>

                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  options-col">
                    <img src="{{ URL::asset('assets1/images/Group 166.png') }}" class="options-img">
                    <div class="card" style="width: 100%; background: #6d78ff;">
                        <div class="card-body">
                            <h3><a href="{{ route('coming.soon') }}">bar Chart</a></h3>

                        </div>

                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  options-col">
                    <img src="{{ URL::asset('assets1/images/Group 164.png') }}" class="options-img">
                    <div class="card" style="width: 100%; background: #366885;">
                        <div class="card-body">
                            <h3><a href="{{ route('coming.soon') }}">Piety Chart</a></h3>

                        </div>

                    </div>

                </div>



            </div>
            <div class="image-div py-4  text-center" style="display: flex; justify-content: center;">
                <img src="{{ URL::asset('assets1/images/Business analytics-cuate.png') }}" style="width: 100%;">

            </div>


        </div>

    </div>
@endsection
