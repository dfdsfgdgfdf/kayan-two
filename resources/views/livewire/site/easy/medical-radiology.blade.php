<div>
    <h3><i class="fas fa-capsules"></i>Medical Radiology</h3>
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
                <button name="answer" value="Show Div" wire:click="add()">Add</button>

            </div>

        </div>
    </div>
    @if (count($data) > 0)
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
                            style="width:20%;  border-right:unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            Control</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $single_data)
                        <tr class="tr-body">
                            <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                <a href="following up details.html">{{ $single_data->name }}</a>
                            </td>
                            <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                <a href="{{ URL::asset('storage/' . $single_data->file) }}" data-lightbox="rad-image">
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
            <div class="row prescription-row mt-6 mb-4">
                <div class="col-xs-12 col-sm-12 col-md-6  mt-3">
                    <label>
                        Name
                        @error('updatMedicalRadiology.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input type="text" wire:model="updatMedicalRadiology.name" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-3 ">
                    <label>
                        File
                        @error('updatMedicalRadiology.file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <small class="py-3"><input class="py-1" style="padding-left: 50px;" type="file"
                            wire:model="updatMedicalRadiology.file"></small>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <label>
                        Note
                        @error('updatMedicalRadiology.note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <input velue=' ' type="text" wire:model="updatMedicalRadiology.note">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3"></div>
                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                    <button name="answer" value="Show Div" wire:click="saveUpdate()">Update</button>

                </div>

            </div>
        </div>
    @endif
</div>

@push('scripts')
    {{-- lightBox --}}
    <script src="{{ URL::asset('assets1/lightbox/dist/js/lightbox.js') }}"></script>
    <script>
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
    </script>
@endpush
