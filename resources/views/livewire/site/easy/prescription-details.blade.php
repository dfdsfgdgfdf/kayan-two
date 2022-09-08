<div>

    <h3><i class="fas fa-capsules"></i>Prescription Details</h3>
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
                <button name="answer" value="Show Div" wire:click="add()">Add</button>

            </div>

        </div>
    </div>
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
                                <a href="following up details.html">{{ $prescription->medicine->name }}</a>
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
                                    <button wire:click="update({{ $index }})"
                                        class="btn btn-icon btn-warning btn-warning11"><i class="fa fa-undo"
                                            aria-hidden="true"></i>
                                    </button>
                                    <button wire:click="alertConfirm({{ $index }})"
                                        class="btn btn-icon waves-effect waves-light btn-danger btn-warning1"> <i
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

    @if ($updateFlag)
        <div class="pers-sec">
            <div class="row prescription-row mt-4 mb-4">
                <div class="col-xs-12 col-sm-12 col-md-4  mt-3">
                    <label>
                        Medicine Name
                        @error('updatPrescription.medicine_id')
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
                        @error('updatPrescription.dose')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input type="text" wire:model="updatPrescription.dose">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3 ">
                    <label>
                        Medicine Time
                        @error('updatPrescription.time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input type="text" wire:model="updatPrescription.time">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <label>
                        Medicine Note
                        @error('updatPrescription.note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input velue=' ' type="text" wire:model="updatPrescription.note">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <button name="answer" value="Show Div" wire:click="saveUpdate()">update</button>

                </div>

            </div>
        </div>
    @endif

</div>
@push('scripts')
    <script>
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
    </script>
@endpush
