<div>
    <!-- start Table-->
    <div class="table-sec-1  ">
        <table style="width: 100%;" class="zui-table zui-table-rounded table-sec-3">
            <thead>
                <tr>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Name</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Note</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Photo</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Date</th>
                    <th
                        style="width:20%; border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    @foreach ($book['medicalTests'] as $medicalTest)
                        <tr class="tr-body">
                            <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                <a href="Medical Radiology Details.html">{{ $medicalTest->name }}</a>
                            </td>
                            <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                <a href="Medical Radiology Details.html">{{ $medicalTest->note }}</a>
                            </td>
                            <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                <a href="{{ URL::asset('storage/' . $medicalTest->file) }}" data-lightbox="test-image">
                                    <img width="50" height="50" class="profile-pic"
                                        src="{{ URL::asset('storage/' . $medicalTest->file) }}" />
                                </a>
                            </td>
                            <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                <a href="Medical Radiology Details.html">{{ $book->date }}</a>
                            </td>
                            <td style="border-right: unset !important; border-left: unset !important; ">
                                <div
                                    style="display: inline-flex; align-items: center; width: 50%; justify-content: center;">
                                    <button wire:click="update({{ $medicalTest->id }})"
                                        class="mx-1 btn btn-icon btn-warning"><i class="fa fa-undo"
                                            aria-hidden="true"></i>
                                    </button>
                                    <button wire:click="alertDeleteConfirm({{ $medicalTest->id }})"
                                        class="btn btn-icon waves-effect waves-light btn-danger"> <i
                                            class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
        @if ($updateFlag)
            <div class="medical-tests-1 py-1" id="addRadiologyDiv" style="display: block;">
                <div class="container">
                    <h6 class="mt-2">Update Medical Test</h6>
                    <div class="medical-sec-5">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                                <label>Name</label>
                                <input type="text" wire:model="singleTest.name">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                                <label>File</label>
                                <input type="file" wire:model="file">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                <label>Note</label>
                                <input type="text" wire:model="singleTest.note">
                            </div>

                        </div>
                    </div>
                    <!-- start save button -->
                    <div class="edit-btn-sec py-2">
                        <div class="row mt-4">
                            <div class="col">
                                <button class="add-button" type="button" wire:click="updateSave()">update</button>
                            </div>
                        </div>

                    </div>
                    <!-- end save button -->

                </div>


            </div>
        @endif

    </div>
    <!-- end Table-->
    <!-- start paganition page  -->
    <div class="table-sec-1">
        <div class="paganition-sec py-4 text-center">
            <div class="row " style="display: inline-block; justify-content: center;">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-12">
                    <ul class="pagination">
                        {{ $books->onEachSide(1)->links() ?? '' }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end paganition page  -->
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

        window.addEventListener('swal:DeleteTestConfirm', event => {
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
