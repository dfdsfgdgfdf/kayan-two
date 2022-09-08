<div class="w-100">
    <div class="personal-info-new-exa mx-3 py-4">
        <div class="container container-1 cont-44">
            <h5> <i class="fas fa-user"></i>Personal Information</h5>
            <div class="row py-4 mt-2 mb-2 row-info">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p> Code:<span>{{ $book->patient->code }}</span></p>
                    <p> Gender: <span>
                            @if ($book->patient->gender)
                                Female
                            @else
                                Male
                            @endif
                        </span></p>
                    <p> Address:<span>{{ $book->patient->city->state }} - {{ $book->patient->city->name }} -
                            {{ $book->patient->address }}</span></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p> Patient Name:<span>{{ $book->patient->name }}</span></p>
                    <p> Age: <span>{{ $book->patient->age }}</span></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    {{-- <p> Chronic Diseases :<span>Pressure, Diabetes</span></p> --}}
                    <p> Phone<span>{{ $book->patient->phone }}</span></p>
                    <p>Last Examination date :<span>{{ $last_exam->date ?? 'No Examination yet' }}</span></p>

                </div>


            </div>

        </div>
        <div class="Diagnosis-Details-sec py-4 mt-5">

            <div class="container container-1 cont-44">
                <h5><i class="fas fa-file-signature"></i>Diagnosis Info</h5>
                @livewire('site.examination.resumption-component.diagnosis', ['patient_id' => $book->patient->id])
            </div>
            <div class="container container-1 prescription-sec row w-100">
                <div class="col-xs-4 col-sm-4 col-md-4">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 my-3">
                    <button type="button" class="w-100" value="Add New Diagnosis" onclick="showDivs(1)">Add
                        Diagnosis</button>
                </div>
            </div>

        </div>
        <div class="The-Details-Of-Patient-Diagonsis py-3" id="addDiagnosisDiv" style="display: none;" wire:ignore>
            <div class="container container-1">
                <h6><i class="fas fa-circle"></i>The Details Of Patient Diagonsis</h6>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                        <form>
                            <label>Diagnosis Info</label>
                            <textarea wire:model="new_info" placeholder="enter all details about the patient ..."></textarea>
                        </form>
                    </div>
                </div>
                <!-- start save button -->
                <div class="edit-btn-sec py-2">
                    <div class="row mt-4">
                        <div class="col">
                            <button class="add-button" type="button"
                                onclick="closeDiv('addDiagnosisDiv')">close</button>
                            <button class="add-button" type="button" wire:click="addInfo()">Save</button>
                        </div>

                    </div>

                </div>
                <!-- end save button -->

            </div>

        </div>


        <!-- start Prescription Details sec  66-->
        <div class="Medical-Tests-Details Diagnosis-Details-sec py-3">
            <div class="container container-1 cont-55">
                <h6><img src="{{ URL::asset('assets1/images/Layer 1.png') }}">Prescription Details</h6>
                <!--  -->
                <div class="w3-bar w3-black"
                    style="padding: 0px 38px; color: #585555!important;background-color: #f7f7f7!important;">
                    <div class="prescription-sec row w-100">
                        <div class="col-xs-12 col-sm-12 col-md-12 my-3 w-100 d-flex justify-content-center ml-3">
                            <button class="m-2" style="width: 33%;" name="answer" value="Show Div"
                                onclick="openCity('Only')">Only</button>
                            <button class="m-2" style="width: 33%;" name="answer" value="Show Div"
                                onclick="openCity('Paris')">All</button>
                        </div>

                    </div>
                </div>

                <div id="Only" class="w3-container city">
                    @livewire('site.examination.resumption-component.prescription-only', ['patient_id' => $book->patient->id])
                </div>

                <div id="Paris" class="w3-container city" style="display:none">
                    @livewire('site.examination.resumption-component.prescription-all', ['patient_id' => $book->patient->id])
                </div>
            </div>
            <div class="container container-1 prescription-sec row w-100">
                <div class="col-xs-4 col-sm-4 col-md-4">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 my-3">
                    <button type="button" class="w-100" value="Add New Diagnosis" onclick="showDivs(2)">Add New
                        Prescription</button>
                </div>
            </div>


        </div>
        <!-- end Prescription Details sec -->
        <div class="medical-tests-1 Prescription-77 py-1" id="addPrescriptionDiv" style="display: none;" wire:ignore>
            <div class="container cont-66">
                <h3><i class="fas fa-pills"></i>Prescription</h3>
                <h5 style="color: #DF3A3A; font-size: 15px;text-align: left;padding-bottom: 10px;"><i
                        class="fas fa-circle"></i> The Medicine Of Patient</h5>
                <div class="medical-sec-55">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <label>
                                Medicine Name
                            </label>
                            <input type="text" list="medicine_name" wire:model="medicin_search" />

                            <datalist id="medicine_name">
                                @foreach ($medicine_names as $medicine_name)
                                    <option>{{ $medicine_name->name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <label>Medicine Dose</label>
                            <input wire:model="new_prescription.dose" type="text">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <label>Medicine Time</label>
                            <input wire:model="new_prescription.time" type="text">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <label>Medicine Note</label>
                            <input wire:model="new_prescription.note" type="text">
                        </div>
                    </div>
                </div>
                <!-- start save button -->
                <div class="edit-btn-sec py-2">
                    <div class="row mt-4">
                        <div class="col">
                            <button class="add-button" type="button"
                                onclick="closeDiv('addPrescriptionDiv')">close</button>
                            <button class="add-button" type="button" wire:click="add_prescription()">Save</button>
                        </div>
                    </div>
                </div>
                <!-- end save button -->
            </div>

        </div>

        <div class="Medical-Tests-Details py-3">
            <div class="container container-1 cont-55">
                <h6><img src="{{ URL::asset('assets1/images/People.png') }}">Medical Tests Details</h6>
                @livewire('site.examination.resumption-component.medical-test', ['patient_id' => $book->patient->id])
            </div>
            <div class="prescription-sec row w-100">
                <div class="col-xs-12 col-sm-12 col-md-12 my-3 w-100 d-flex justify-content-center ml-3">
                    <button class="m-2" style="width: 33%;" name="answer" value="Show Div"
                        onclick="showDivs(3)">Add New Medical Test</button>
                </div>

            </div>


        </div>

        <div class="medical-tests-1 py-1" id="addTestsDiv" style="display: none;" wire:ignore>
            <div class="container">
                <h6><img src="{{ URL::asset('assets1/images/People.png') }}">Medical Tests</h6>
                <h5><i class="fas fa-circle"></i> The Tests Of Patient</h5>
                <div class="medical-sec-5">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <label>Name</label>
                            <input type="text" wire:model="medical_test.name">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <label>File</label>
                            <input type="file" wire:model="medical_test.file">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <label>Note</label>
                            <input type="text" wire:model="medical_test.note">
                        </div>
                    </div>
                </div>
                <!-- start save button -->
                <div class="edit-btn-sec py-2">
                    <div class="row mt-4">
                        <div class="col">
                            <button class="add-button" type="button"
                                onclick="closeDiv('addTestsDiv')">close</button>
                            <button class="add-button" type="button" wire:click="add_test()">Save</button>

                        </div>

                    </div>

                </div>
                <!-- end save button -->

            </div>


        </div>




        <div class="Medical-Tests-Details py-3">
            <div class="container container-1 cont-55">
                <h6><img src="{{ URL::asset('assets1/images/CT_Scan.png') }}">Medical Radiology Details</h6>
                @livewire('site.examination.resumption-component.medical-radiology', ['patient_id' => $book->patient->id])


            </div>

            <div class="prescription-sec row w-100">
                <div class="col-xs-12 col-sm-12 col-md-12 my-3 w-100 d-flex justify-content-center ml-3">
                    <button class="m-2" style="width: 33%;" name="answer" value="Show Div"
                        onclick="showDivs(4)">Add
                        New Medical radiology</button>
                </div>

            </div>

        </div>

        <div class="medical-tests-1 py-1" id="addRadiologyDiv" style="display: none;" wire:ignore>
            <div class="container">
                <h6><img src="{{ URL::asset('assets1/images/People.png') }}">Medical Radiology</h6>
                <h5><i class="fas fa-circle"></i> The Radiology Of Patient</h5>
                <div class="medical-sec-5">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <label>Name</label>
                            <input type="text" wire:model="medical_radiology.name">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <label>File</label>
                            <input type="file" wire:model="medical_radiology.file">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <label>Note</label>
                            <input type="text" wire:model="medical_radiology.note">
                        </div>

                    </div>
                </div>
                <!-- start save button -->
                <div class="edit-btn-sec py-2">
                    <div class="row mt-4">
                        <div class="col">
                            <button class="add-button" type="button"
                                onclick="closeDiv('addRadiologyDiv')">close</button>
                            <button class="add-button" type="button" wire:click="add_radiology()">Save</button>
                        </div>
                    </div>

                </div>
                <!-- end save button -->

            </div>


        </div>

        <div class="prescription-sec row w-100">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3 w-100 d-flex justify-content-center ml-3">
                <button class="m-2" style="width: 100%;" name="answer" value="Show Div"
                    wire:click="done">Save</button>
            </div>
        </div>
    </div>
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

        function showDivs(key) {
            if (key == 1) {
                document.getElementById('addDiagnosisDiv').style.display = "block";
            } else if (key == 2) {
                document.getElementById('addPrescriptionDiv').style.display = "block";
            } else if (key == 3) {
                document.getElementById('addTestsDiv').style.display = "block";
            } else if (key == 4) {
                document.getElementById('addRadiologyDiv').style.display = "block";
            }
        }
        window.addEventListener('swal:modal', event => {
            // document.getElementById('addDiagnosisDiv').style.display = "none";
            // document.getElementById('addPrescriptionDiv').style.display = "none";
            // document.getElementById('addTestsDiv').style.display = "none";
            // document.getElementById('addRadiologyDiv').style.display = "none";
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                timer: 1000
            });
        });
        window.addEventListener('swal:modal:false', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });

        function closeDiv(key) {
            document.getElementById(key).style.display = "none";
        }

        // window.addEventListener('show:prescription', () => {
        //     $(prescription).modal('show')
        // })
    </script>
@endpush
