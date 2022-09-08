<!-- ========== Left Sidebar Start ========== -->

<div class="left-side-menu">
<div class="slimscroll-menu">
    
    <!-- User box -->
    <div class="user-box text-center mb-3">
        <img src="{{ URL::asset('assets/images/users/default.png') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
        
        <div class="dropdown">
            <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown"  aria-expanded="false">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">

            <li class="menu-title">General</li>

            <li>
                <a href="{{ route('dashboard.home') }}">
                    <i class="fas fa-home"></i>
                    <span> Home </span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="dripicons-gear"></i>
                    <span> Setteing </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{ route('dashboard.Specializations') }}">Specializations</a></li>
                    <li><a href="{{ route('dashboard.Cities') }}">Cities</a></li>

                </ul>
            </li>

            <li class="menu-title">Doctors</li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-doctor"></i>
                    <span> Doctors </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{ route('dashboard.doctors', 1 ) }}">Activated</a></li>
                    <li><a href="{{ route('dashboard.doctors', 0 ) }}">Inactived</a></li>
                    <li><a href="{{ route('dashboard.doctors', 2 ) }}">Archived</a></li>
                </ul>
            </li>
        
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-email"></i>
                    <span> Mail </span>
                    @if( $public_data['admin_messages'] != 0)
                    <span class="mr-3 float-right badge badge-danger rounded-circle noti-icon-badge">{{ $public_data['admin_messages'] }}</span>
                    @endif
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{ route('dashboard.messages.list' , 1) }}">Received</a></li>
                    <li><a href="{{ route('dashboard.messages.list' , 2) }}">Sent</a></li>
                    <li><a href="{{ route('dashboard.messages.send')}}">New</a></li>
                </ul>
            </li>

            <li class="menu-title">Patients</li>

            <li>
                <a href="ui-typography.html">
                    <i class="mdi mdi-format-font"></i>
                    <span> Typography </span>
                </a>
            </li>

            <li class="menu-title">Medical Labs</li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->