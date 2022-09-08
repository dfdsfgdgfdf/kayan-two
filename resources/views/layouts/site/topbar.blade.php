<div class="first-bar py-4">
    <div class="container container-1">
        <div class="row row-firstbar text-right">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="row">
                    @if($public_data['doctor_messages'] != 0 )
                    <div class="col-xs-1 col-sm-2 col-md-2 col-lg-1 ">
                        <span class="badge badge-pill badge-danger">{{ $public_data['doctor_messages'] }}</span>
                    </div>
                    @endif
                    <div style="display: inline" class="col-xs-2 col-sm-2 col-md-2 col-lg-1 ">
                        <a href="{{ route('doctor.messages.list', 1) }}">
                            <i class="far fa-envelope firstbar-icon"></i>
                        </a>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <div class="dropdown dropdown-dr" style="padding-top: 7px;">
                            <a href="#" class="text-font-times font-size-m dropdown-toggle" data-toggle="dropdown"
                                role="button" aria-haspopup="true" aria-expanded="false"><span>dr.
                                    {{ auth()->user()->name }}</span> <img class="doctor"
                                    src="{{ URL::asset('storage/' . auth()->user()->image) }}" style="width: 25px;"
                                    alt="doctor icon"></a>
                            <ul class="dropdown-menu dr">
                                <li><a>{{ auth()->user()->name }}</a></li>
                                <li><a>{{ auth()->user()->email }}</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a href="{{ route('doctor.setting') }}">settings</a></li>
                                <li><a href="{{ route('doctor.change.password') }}">change password</a></li>
                                <li><a href="{{ route('doctor.logout') }}">log out</a></li>
                            </ul>
                        </div>
                    </div>

                </div>


            </div>


        </div>

    </div>

    <!-- end first bar -->
</div>
