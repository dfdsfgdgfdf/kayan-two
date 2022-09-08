<div class="sidebar sidenav text-center " style="width: 25%;">
    <a href="{{ route('doctor.home') }}"><img src="{{ URL::asset('assets1/images/Capture1.png') }}"
            class="logo-image"></a>
    <ul class="nav">
        <li><a href="{{ route('doctor.easy.patients') }}" class="link-sidebar"><i
                    class="fas fa-lightbulb"></i>Easy</a></li>
        <li><a href="{{ route('doctor.new.reservation') }}" class="link-sidebar"> <i
                    class="fas fa-user-plus icon"></i>Add Patient</a></li>
        <li><a href="{{ route('doctor.followingUp') }}" class="link-sidebar"></i><i class="fas fa-arrow-up icon"></i>
                following Up</a></li>
        <li><a href="{{ route('doctor.Examination') }}" class="link-sidebar"><i class="fas fa-stethoscope icon"></i>
                Examination</a></li>
        <li><a href="{{ route('doctor.patients.list') }}" class="link-sidebar"><i class="fa fa-users"></i> All
                Patients</a></li>
        <li><a href="{{ route('coming.soon') }}" class="link-sidebar"><i class="fas fa-globe icon"></i>Live </a></li>
        <li><a href="{{ route('coming.soon') }}" class="link-sidebar"><i class="fas fa-vials icon"></i>Medical Tests
            </a></li>
        <li><a href="{{ route('doctor.reports') }}" class="link-sidebar"><i class="far fa-file-alt icon"></i>Account
                reports</a></li>
    </ul>
    {{-- <div class="image-sidebar mt-4 mb-4  text-center ">
        <img src="{{ URL::asset('assets1/images/Online Doctor-amico (3).png') }}" style="width: 50%;">
        <p class="image-desc">
            Click here to update the<br>
            system now and Enjoy the<br>
            latest features
        </p>

    </div> --}}
</div>
