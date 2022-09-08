<div>
    <div class="person-info-details py-4">
        <div class="container">

            <div class="personal-info-new-exa mx-3 py-4" style="border:unset;">
                <div class="info44444 d-flex" style="justify-content: center;">

                    <div class=" text-center">
                        <div class="card" style="width: 100%;">
                            @if ($patient->gender)
                                <img src="{{ URL::asset('assets1/images/Group 596.png') }}" class="img-top ">
                            @else
                                <img src="{{ URL::asset('assets1/images/Group 476.png') }}" class="img-top ">
                            @endif

                            <div class="card-body">
                                <div class="row mb-1 ">
                                    <div class="col">
                                        <h4 class="text-font-times font-size-l "
                                            style="font-size: x-large; padding-top: 5px;">{{ $patient->name }}</h4>
                                    </div>
                                </div>
                                <p class="last-exa"> <i class="far fa-calendar-alt"></i>Last Examination Date</p>
                                <p class="date-1" style="font-size:13px">
                                    {{ $last_exam->date ?? 'No Examination yet' }}</p>
                                <div class="col mt-2">
                                    <button
                                        style="border: 1px solid #6c75e6;background: #6c75e6;color: white;border-radius: 18px; width: 77px;font-size: 14px;margin: 5px 0px;">View</button>
                                    <button wire:click="reservation()"
                                        style="border: 1px solid #6c75e6;background: #6c75e6;color: white;border-radius: 18px; width: 77px;font-size: 14px; margin: 5px 0px;">New
                                        data</button>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="patient-informations py-4">
                    <div class="cont-33 container">
                        <div class="row py-4 mt-2 mb-2 row-info">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <p class="text-font-times"><i class="fas fa-id-card-alt"></i> Id
                                    No:<span>{{ $patient->code }}</span></p>
                                <p class="text-font-times"><i class="fas fa-venus-mars"></i> Gender: <span>
                                        @if ($patient->gender)
                                            Female
                                        @else
                                            Male
                                        @endif
                                    </span></p>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <p class="text-font-times"><i class="fas fa-phone"></i>
                                    Phone<span>{{ $patient->phone }}</span></p>
                                <p class="text-font-times"> <i class="fas fa-portrait"></i>Age:
                                    <span>{{ $patient->age }}</span>
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <p class="text-font-times"><i class="fas fa-map-marker-alt"></i>
                                    Location:<span>{{ $patient->city->state }} -
                                        {{ $patient->city->name }} -
                                        {{ $patient->address }}</span></p>
                            </div>
                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            </div>

                            <div class="col-xs-3 col-sm-12 col-md-12 col-lg-3 mt-3">

                                <button  class="w-100" onclick="showUpdateDiv()"
                                    style="border: 1px solid #6c75e6;background: #6c75e6;color: white;border-radius: 18px; font-size: 14px; margin: 5px 0px;">Update
                                    data</button>
                            </div>


                        </div>

                    </div>

                </div>

                <div wire:ignore id="infoUpdate" class="patient-informations py-4" style="display: none">
                    <div  class="cont-33 container">
                        <div class="patient-info w-100" style="border-style: none;">
                            <h3 style="text-align: left;color: #E62E66;"><i class="fas fa-user"></i>Update Personal
                                Information</h3>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                                    <label>
                                        Patient name
                                        @error('patient.name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input wire:ignore name="name" wire:model.defer="patient.name" type="text">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                                    <label>
                                        age
                                        @error('patient.age')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input name="age" wire:model.defer="patient.age" type="text">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                                    <label>
                                        Phone number
                                        @error('patient.phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input name="phone" wire:model.defer="patient.phone" type="text">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">

                                    <label>
                                        City @error('patient.city_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <select wire:model.defer="patient.city_id" name="city">
                                        <option value="0" selected>choose </option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                                    <label>
                                        address
                                        @error('patient.address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input wire:model.defer="patient.address" type="text">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                                    <label>
                                        gender
                                        @error('patient.gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <select wire:model.defer="patient.gender">
                                        <option selected hidden>choose</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col-xs-12 col-sm-12 col-md-4"></div>
                                <div class="col-xs-12 col-sm-12 col-md-4"></div>
                                <div class="col-xs-12 col-sm-12 col-md-4">

                                    <button class="done-button mr-1" name="answer" value="Show Div"
                                        onclick="closeUpdateDiv()"
                                        style="width: 44%; border-radius: 30px;height: 35px;">Close</button>
                                    <button class="done-button mr-1" name="answer" value="Show Div" wire:click="updateInfo()"
                                        style="width: 44%; border-radius: 30px;height: 35px;">Save</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                
                @if ($patient->note)
                    <div class="patient-note py-4 mt-2 mb-2">
                        <div class="cont-33 container">
                            <p style="overflow-wrap:break-word;">{{ $patient->note }}</p>

                        </div>

                    </div>
                @endif

                <div class="Diagnosis-Details-sec py-4">

                    <div class="container container-1 cont-44">
                        <h5><i class="fas fa-file-signature"></i>Diagnosis Info</h5>
                        @livewire('site.examination.resumption-component.diagnosis', ['patient_id' => $patient->id])
                    </div>

                </div>

                <div class="Medical-Tests-Details Diagnosis-Details-sec py-3">
                    <div class="container container-1 cont-55">
                        <h6><img src="{{ URL::asset('assets1/images/Layer 1.png') }}">Prescription Details</h6>
                        <div class="w3-bar w3-black"
                            style="padding: 0px 38px; color: #585555!important;background-color: #f7f7f7!important;">
                            <div class="prescription-sec row w-100">
                                <div
                                    class="col-xs-12 col-sm-12 col-md-12 my-3 w-100 d-flex justify-content-center ml-3">
                                    <button class="m-2" name="answer" value="Show Div"
                                        onclick="openCity('Only')">Only</button>
                                    <button class="m-2" name="answer" value="Show Div"
                                        onclick="openCity('Paris')">All</button>
                                </div>

                            </div>
                        </div>

                        <div id="Only" class="w3-container city">
                            @livewire('site.examination.resumption-component.prescription-only', ['patient_id' => $patient->id])
                        </div>

                        <div id="Paris" class="w3-container city" style="display:none">
                            @livewire('site.examination.resumption-component.prescription-all', ['patient_id' => $patient->id])
                        </div>
                    </div>


                </div>

                <div class="Medical-Tests-Details py-3">
                    <div class="container container-1 cont-55">
                        <h6><img src="{{ URL::asset('assets1/images/People.png') }}">Medical Tests Details</h6>
                        @livewire('site.examination.resumption-component.medical-test', ['patient_id' => $patient->id])
                    </div>
                </div>

                <div class="Medical-Tests-Details py-3">
                    <div class="container container-1 cont-55">
                        <h6><img src="{{ URL::asset('assets1/images/CT_Scan.png') }}">Medical Radiology Details</h6>
                        @livewire('site.examination.resumption-component.medical-radiology', ['patient_id' => $patient->id])


                    </div>
                </div>
            </div>
        </div>
        <!-- end personal-info-details  -->
    </div>
</div>
@push('scripts')
    <script>
        function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }

        function showUpdateDiv() {
            document.getElementById('infoUpdate').style.display = "block";
        }

        function closeUpdateDiv() {
            document.getElementById('infoUpdate').style.display = "none";
        }

        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                timer: 1000
            });
        });
    </script>
@endpush
