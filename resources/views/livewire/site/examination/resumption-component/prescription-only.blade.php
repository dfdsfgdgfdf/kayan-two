<div>

    <div class="table-sec-1">
        <table style="width: 100%;" class="zui-table zui-table-rounded table-sec-3">
            <thead>
                <th
                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                    Medicine Name</th>
                <th
                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                    Medicine Dose</th>
                <th
                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                    Medicine Time</th>
                <th
                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                    Date</th>
                <th
                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                    Control</th>
            </thead>
            <tbody>
                @foreach ($prescription as $single_prescription)
                    <tr class="tr-body">
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a>{{ $single_prescription->medicine->name }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a>{{ $single_prescription->dose }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a>{{ $single_prescription->time }}
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a>{{ $single_prescription->created_at }}</a>
                        </td>
                        <td style="border-right: unset !important; border-left: unset !important; ">
                            <div
                                style="display: inline-flex; align-items: center; width: 50%; justify-content: center;">
                                <button wire:click="update({{ $single_prescription->id }})"
                                    class="mx-1 btn btn-icon btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>
                                </button>
                                <button wire:click="alertDeleteConfirm({{ $single_prescription->id }})"
                                    class="btn btn-icon waves-effect waves-light btn-danger"> <i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        @if ($updateFlag)
            <div class="medical-tests-1 Prescription-77 py-1" id="addPrescriptionDiv" style="display: block;">
                <div class="container cont-66">
                    <h3><i class="fas fa-pills"></i> Update Prescription</h3>
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
                                <input wire:model="single.dose" type="text">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                                <label>Medicine Time</label>
                                <input wire:model="single.time" type="text">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                                <label>Medicine Note</label>
                                <input wire:model="single.note" type="text">
                            </div>
                        </div>
                    </div>
                    <!-- start save button -->
                    <div class="edit-btn-sec py-2">
                        <div class="row mt-4">
                            <div class="col">
                                <button class="add-button" type="button" wire:click="updateSave()">Update</button>
                            </div>
                        </div>
                    </div>
                    <!-- end save button -->
                </div>

            </div>
        @endif

    </div>

    <div class="table-sec-1">
        <div class="paganition-sec py-4 text-center">
            <div class="row " style="display: inline-block; justify-content: center;">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-12">
                    <ul class="pagination">
                        {{ $prescription->onEachSide(1)->links() ?? '' }}
                    </ul>
                </div>
            </div>
        </div>
    </div>



</div>

@push('scripts')
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                timer: 1000,
            });
        });

        window.addEventListener('swal:DeletePreConfirm', event => {
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
                        window.livewire.emit('delete');
                    }
                });
        });
    </script>
@endpush
