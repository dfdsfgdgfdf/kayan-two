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
                    <p> Address:<span>{{ $book->patient->city->state ?? '' }} - {{ $book->patient->city->name }} -
                            {{ $book->patient->address }}</span></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p> Patient Name:<span>{{ $book->patient->name }}</span></p>
                    <p> Age: <span>{{ $book->patient->age }}</span></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    {{-- <p> Chronic Diseases :<span>Pressure, Diabetes</span></p> --}}
                    <p> Phone<span>{{ $book->patient->phone }}</span></p>
                    <p>Last Examination date :<span>2-2-2021</span></p>

                </div>


            </div>

        </div>
        <div class="container container-1 cont-44 mt-5">
            <div class="prescription-sec">
                <h6 class="mt-3"><i class="fas fa-file-signature"></i>Diagnosis Info</h6>
                <textarea wire:model="diagnosisInfo">

                </textarea>
            </div>
            <hr>
            <div class="prescription-sec">
                <h6 class="mt-3"><i class="fas fa-capsules"></i>Prescription Details</h6>
                @if (count($prescriptions) > 0)
                    <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Name</th>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Dose</th>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Time</th>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        note</th>
                                    <th
                                        style="width:20%; border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prescriptions as $index => $prescription)
                                    <tr class="tr-body">
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a
                                                href="following up details.html">{{ $prescription->medicine->name }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="following up details.html">{{ $prescription->dose }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="following up details.html">{{ $prescription->time }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="following up details.html">{{ $prescription->note }} </a>
                                        </td>
                                        <td style="border-right: unset !important; border-left: unset !important; ">
                                            <div
                                                style="display: inline-flex; align-items: center; width: 50%; justify-content: center;">
                                                <button wire:click="updatePrescription({{ $index }})"
                                                    class="btn btn-icon btn-danger"><i class="fa fa-undo"
                                                        aria-hidden="true"></i>
                                                </button>
                                                <button wire:click="alertPrescriptionsConfirm({{ $index }})"
                                                    class="btn btn-icon waves-effect waves-light btn-danger"> <i
                                                        class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if ($updatePreFlag)
                    <h6 class="mt-3"><i class="fas fa-capsules"></i>Update Prescription Details</h6>
                    <div class="pers-sec">
                        <div class="row prescription-row mt-4 mb-4">
                            <div class="col-xs-12 col-sm-12 col-md-4  mt-3">
                                <label>
                                    Medicine Name
                                    @error('prescriptions.{{ $updatePreIndex }}.medicine.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" list="medicine_name"
                                    wire:model="prescriptions.{{ $updatePreIndex }}.medicine.name" />

                                <datalist id="medicine_name">
                                    @foreach ($medicine_names as $medicine_name)
                                        <option>{{ $medicine_name->name }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3 ">
                                <label>
                                    Medicine Dose
                                    @error('prescriptions.{{ $updatePreIndex }}.dose')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" wire:model="prescriptions.{{ $updatePreIndex }}.dose">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3 ">
                                <label>
                                    Medicine Time
                                    @error('prescriptions.{{ $updatePreIndex }}.time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" wire:model="prescriptions.{{ $updatePreIndex }}.time">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                <label>
                                    Medicine Note
                                    @error('prescriptions.{{ $updatePreIndex }}.note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input velue=' ' type="text"
                                    wire:model="prescriptions.{{ $updatePreIndex }}.note">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                                <button name="answer" value="Show Div"
                                    wire:click="updatePrescriptionSave()">Update</button>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="pers-sec">
                    <div class="row prescription-row mt-4 mb-4">
                        <div class="col-xs-12 col-sm-12 col-md-4  mt-3">
                            <label>
                                Medicine Name
                                @error('medicine.name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" list="medicine_name" wire:model="medicin_search" />

                            <datalist id="medicine_name">
                                @foreach ($medicine_names as $medicine_name)
                                    <option>{{ $medicine_name->name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3 ">
                            <label>
                                Medicine Dose
                                @error('medicine.dose')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model="medicine.dose">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3 ">
                            <label>
                                Medicine Time
                                @error('medicine.time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model="medicine.time">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <label>
                                Medicine Note
                                @error('medicine.note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input velue=' ' type="text" wire:model="medicine.note">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <button name="answer" value="Show Div" wire:click="add_prescriptions()">Add</button>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="prescription-sec">
                <h6><i class="fas fa-capsules"></i>Medical Radiology</h6>
                @if (count($medicalRadiology) > 0)
                    <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Name</th>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Image</th>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        note</th>
                                    <th
                                        style="width:20%; border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Control </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicalRadiology as $index => $single_data)
                                    <tr class="tr-body">
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="following up details.html">{{ $single_data->name }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="{{ URL::asset('storage/' . $single_data->file) }}"
                                                data-lightbox="rad-image">
                                                <img width="50" height="50" class="profile-pic"
                                                    src="{{ URL::asset('storage/' . $single_data->file) }}" />
                                            </a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="following up details.html">{{ $single_data->note }} </a>
                                        </td>
                                        <td style="border-right: unset !important; border-left: unset !important; ">
                                            <div
                                                style="display: inline-flex; align-items: center; width: 50%; justify-content: center;">
                                                <button wire:click="updateRad({{ $index }})"
                                                    class="btn btn-icon btn-danger"><i class="fa fa-undo"
                                                        aria-hidden="true"></i>
                                                </button>
                                                <button wire:click="alertRadiologyConfirm({{ $index }})"
                                                    class="btn btn-icon waves-effect waves-light btn-danger"> <i
                                                        class="fas fa-times"></i>
                                                </button>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if ($updateRadFlag)
                    <h6><i class="fas fa-capsules"></i>Update Medical Radiology</h6>
                    <div class="pers-sec">
                        <div class="row prescription-row mt-6 mb-4">
                            <div class="col-xs-12 col-sm-12 col-md-6  mt-3">
                                <label>
                                    Name
                                    @error('medicalRadiology.{{ $updateRadIndex }}.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" wire:model="medicalRadiology.{{ $updateRadIndex }}.name" />
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 mt-3 ">
                                <label>
                                    File
                                </label>
                                <small class="py-3"><input class="py-1" style="padding-left: 50px;"
                                        type="file" wire:model="updateRadImage"></small>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                <label>
                                    Note
                                    @error('medicalRadiology.{{ $updateRadIndex }}.note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input velue=' ' type="text"
                                    wire:model="medicalRadiology.{{ $updateRadIndex }}.note">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                                <button name="answer" value="Show Div" wire:click="updateRadSave()">Update</button>

                            </div>

                        </div>
                    </div>
                @endif
                <div class="pers-sec">
                    <div class="row prescription-row mt-6 mb-4">
                        <div class="col-xs-12 col-sm-12 col-md-6  mt-3">
                            <label>
                                Name
                                @error('medical_radiology.name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model="medical_radiology.name" />
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-3 ">
                            <label>
                                File
                                @error('medical_radiology.file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <small class="py-3"><input class="py-1" style="padding-left: 50px;" type="file"
                                    wire:model="medical_radiology.file"></small>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <label>
                                Note
                                @error('medical_radiology.note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input velue=' ' type="text" wire:model="medical_radiology.note">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <button name="answer" value="Show Div" wire:click="addRadiology()">Add</button>

                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="prescription-sec">
                <h3><i class="fas fa-capsules"></i>Medical Test</h3>
                @if (count($medicalTest) > 0)
                    <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Name</th>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Image</th>
                                    <th
                                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        note</th>
                                    <th
                                        style="width:20% border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                        Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicalTest as $index => $single_data)
                                    <tr class="tr-body">
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="following up details.html">{{ $single_data->name }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="{{ URL::asset('storage/' . $single_data->file) }}"
                                                data-lightbox="test-image">
                                                <img width="50" height="50" class="profile-pic"
                                                    src="{{ URL::asset('storage/' . $single_data->file) }}" />
                                            </a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a href="following up details.html">{{ $single_data->note }} </a>
                                        </td>
                                        <td style="border-right: unset !important; border-left: unset !important; ">
                                            <div
                                                style="display: inline-flex; align-items: center; width: 50%; justify-content: center;">
                                                <button wire:click="updateTest({{ $index }})"
                                                    class="btn btn-icon btn-danger"><i class="fa fa-undo"
                                                        aria-hidden="true"></i>
                                                </button>
                                                <button wire:click="alertTestConfirm({{ $index }})"
                                                    class="btn btn-icon waves-effect waves-light btn-danger"> <i
                                                        class="fas fa-times"></i>
                                                </button>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if ($updateTestFlag)
                    <h3><i class="fas fa-capsules"></i>Update Medical Test</h3>
                    <div class="pers-sec">
                        <div class="row prescription-row mt-6 mb-4">
                            <div class="col-xs-12 col-sm-12 col-md-6  mt-3">
                                <label>
                                    Name
                                    @error('medicalTest.{{ $updateTestIndex }}.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" wire:model="medicalTest.{{ $updateTestIndex }}.name" />
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 mt-3 ">
                                <label>
                                    File
                                </label>
                                <small class="py-3"><input class="py-1" style="padding-left: 50px;"
                                        type="file" wire:model="updateTestImage"></small>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                <label>
                                    Note
                                    @error('medicalTest.{{ $updateTestIndex }}.note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input velue=' ' type="text"
                                    wire:model="medicalTest.{{ $updateTestIndex }}.note">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                                <button name="answer" value="Show Div" wire:click="updateTestSave()">Update</button>

                            </div>

                        </div>
                    </div>
                @endif
                <div class="pers-sec">
                    <div class="row prescription-row mt-6 mb-4">
                        <div class="col-xs-12 col-sm-12 col-md-6  mt-3">
                            <label>
                                Name
                                @error('medical_test.name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model="medical_test.name" />
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-3 ">
                            <label>
                                File
                                @error('medical_test.file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <small class="py-3"><input class="py-1" style="padding-left: 50px;" type="file"
                                    wire:model="medical_test.file"></small>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <label>
                                Note
                                @error('medical_test.note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <input velue='note' type="text" wire:model="medical_test.note">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3 text-center">
                            <button name="answer" value="Show Div" wire:click="addTese()"
                                class="addd-22">Add</button>

                        </div>

                    </div>
                </div>

            </div>

            <div class="prescription-sec row w-100">
                <div class="col-xs-12 col-sm-12 col-md-12 my-3 w-100 d-flex justify-content-center ml-3">
                    <div class="row text-center">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <button class="m-2" style="" name="answer" value="Show Div"
                                wire:click="save()">Sava</button>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            @livewire('site.prescription.modal', ['book_id' => $book->id])  
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <button class="m-2" style="" name="answer" value="Show Div"
                                wire:click="done">Done</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>

</div>
<!-- end modal -->
</div>

@push('scripts')
    {{-- lightBox --}}
    <script src="{{ URL::asset('assets1/lightbox/dist/js/lightbox.js') }}"></script>
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                timer: 1000,
            });
        });

        window.addEventListener('swal:confirmDeletePrescription', event => {
            swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    showCancelButton: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        window.livewire.emit('deletePrescription');
                    }
                });
        });

        window.addEventListener('swal:confirmDeleteRadiology', event => {
            swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    showCancelButton: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        window.livewire.emit('deleteRadiology');
                    }
                });
        });

        window.addEventListener('swal:confirmDeleteTest', event => {
            swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    showCancelButton: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        window.livewire.emit('deleteTest');
                    }
                });
        });

    </script>
@endpush
