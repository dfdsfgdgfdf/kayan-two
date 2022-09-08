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
                <button  class="button-1 button_slide slide_left w-100"><a
                    class="link-1 text-font-times link-btn" > Online Reservation</a></button>
            </div>
        </div>
    </div>
    <!-- end info sec -->

    {{-- start all patient --}}
    <div class="search-row py-1 text-center">
        <div class="container container-1">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                    <div class="form-outline">
                        <input type="search" id="form1" wire:model="searchItem" class="form-control"
                            placeholder="Searching here by patient code , name or number" aria-label="Search" />
                        <div class="mt-1" wire:loading>Searching ...</div>
                        <div wire:loading.remove></div>
                    </div>
                </div>
            </div><hr>
            <!-- start table sec -->
            @if(count($patients) > 0)
            <div class="table-sec table-1 py-1 text-center">
                <div class="container container-1">
                    <div class="table-section  container-msg-1 mb-3 mt-3  ">
                        <table style=" width: 100%" class="zui-table zui-table-rounded">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Number</th>
                                    <th>Add</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $index => $patient)
                                <tr>
                                    <td><a>{{ $patient->code }}</a></td>
                                    <td><a>{{ $patient->name }}</a></td>
                                    <td><a>{{ $patient->city->name ?? '' }}</a></td>
                                    <td><a>{{{ $patient->phone }}}</a></td>
                                    <td>
                                        <div class="row" style="justify-content: center;">
                                            <button class="accept" style="background: unset; border: unset;"> <i
                                                    class="fas fa-check-circle" wire:click="add({{ $patient->id }})"></i> </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            @else
            <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                <img src="{{ URL::asset('assets1/images/nodata.webp') }}" style="width: 50%;">
            </div>
            @endif
            <!-- end table sec -->


            <div class="personal-information py-3 container">
            {{-- start add reservation --}}
            @livewire('site.add-patient.reservation')
            {{-- end add reservation --}}
            </div>
        </div>
    </div>
    {{-- end all patient --}}




</div>
