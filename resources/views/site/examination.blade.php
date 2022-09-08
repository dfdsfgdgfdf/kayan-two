@extends('layouts.site.base')
@section('content')
<!-- start options sec -->
<div class="options-sec py-4" style="width: 100%;">
    <div class="container container-1" style="width: 85%;">
        <div class="row mt-3 options-row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  options-col">
                <img src="{{ URL::asset('assets1/images/Group 368.png') }}" class="options-img">
                <div class="card" style="width: 100%; background: #6d78ff;">
                  <div class="card-body">
                      <h3><a href="{{ route('doctor.Examination.list', 'new') }}">New</a></h3>

                  </div>

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  options-col">
              <img src="{{ URL::asset('assets1/images/Group 597.png') }}" class="options-img">
              <div class="card" style="width: 100%; background: #366885;">
                <div class="card-body">
                    <h3><a href="{{ route('doctor.Examination.list', 'resumption') }}">Resumption</a></h3>

                </div>

              </div>

          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  options-col">
              <img src="{{ URL::asset('assets1/images/Group 598.png') }}" class="options-img">
              <div class="card" style="width: 100%;background: #D95151;">
                <div class="card-body">
                    <h3><a>Waiting</a></h3>

                </div>

              </div>

          </div>
         

        </div>
        <div class="image-div py-4  text-center" >
          <div class="row ">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">

              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                  <img src="{{ URL::asset('assets1/images/depositphotos_311498908-stock-illustration-medicine-treatment-doctor-online-flat.png') }}" style="width: 100%;">

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">

            </div>

          </div>

        </div>
        

    </div>

</div>
<!-- end options sec -->
@endsection