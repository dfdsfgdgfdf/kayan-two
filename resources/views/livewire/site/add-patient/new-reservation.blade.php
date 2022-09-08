<div class="w-100">
    <!-- start info sec -->
    <div class="info-sec-1 py-1 text-center ">
        <div class="row w-100 ml-1">
            <div class="col-xs-12 col-xs-12 col-md-4 mt-2" >
                {{-- <button class="button-1 active button_slide slide_left"><a href="{{ route('doctor.new.reservation') }}"
                        class="link-1 link-btn">New Reservation </a></button> --}}
                <button onclick="location.href='{{ route('doctor.new.reservation') }}';" class="button-1 button_slide slide_left w-100"><a
                            class="link-1 text-font-times link-btn" > New Reservation</a></button>
            </div>
            <div class="col-xs-12 col-xs-12 col-md-4 mt-2" >
                {{-- <button class="button-1 button_slide slide_left"><a href="{{ route('doctor.old.reservation') }}" class="link-2 link-btn">Old
                        Reservation </a></button> --}}
                <button onclick="location.href='{{ route('doctor.old.reservation') }}';" class="button-1 button_slide slide_left w-100"><a
                        class="link-1 text-font-times link-btn" > Old Reservation</a></button>
            </div>
            <div class="col-xs-12 col-xs-12 col-md-4 mt-2" >
                {{-- <button class="button-1 button_slide slide_left"><a 
                        class="link-3 link-btn">Online Reservation </a></button> --}}
                <button class="button-1 button_slide slide_left w-100"><a
                    class="link-1 text-font-times link-btn" > Online Reservation</a></button>
            </div>
        </div>
    </div>
    <!-- end info sec -->


    <div class="patient-info w-100">
        {{-- start add patient --}}
        @livewire('site.add-patient.add-patient')
        {{--  end add patient  --}}


        {{-- start add reservation --}}
        @livewire('site.add-patient.reservation')
        {{--  end add reservation  --}}
    </div>

</div>
