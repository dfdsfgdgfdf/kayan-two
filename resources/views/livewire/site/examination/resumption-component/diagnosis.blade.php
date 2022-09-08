<div>
    @if (count($diagnosis) > 0)
        <h6><i class="fas fa-circle"></i>Notes</h6>
        @foreach ($diagnosis as $single_diagnosis)
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 notes-cont">
                    <p style="overflow-wrap:break-word;" class="notes-paragraph-1">
                        <button wire:click="alertDeleteConfirm({{ $single_diagnosis->id }})"
                            class="float-right mb-3 mx-1 btn btn-icon waves-effect waves-light btn-danger"> <i
                                class="fas fa-times"></i>
                        </button>
                        <button wire:click="update({{ $single_diagnosis->id }})"
                            class="float-right mb-3 mx-1 btn btn-icon btn-warning"><i class="fa fa-undo"
                                aria-hidden="true"></i>
                        </button>

                        <br><br>
                        {{ $single_diagnosis->content }}
                    </p>
                    @if ($updateFlage)
                        <textarea style="width:90%; overflow-wrap:break-word;" wire:model="sigleDiagnois.content" class="notes-paragraph-1"></textarea>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="table-sec-1">
            <div class="paganition-sec py-4 text-center">
                <div class="row " style="display: inline-block; justify-content: center;">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-12">
                        <ul class="pagination">
                            @if ($updateFlage)
                                <button wire:click="updateSave()" class="mb-3 mx-1 btn btn-icon btn-info"> save
                                </button><br>
                            @else
                                {{ $diagnosis->onEachSide(1)->links() ?? '' }}
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h6><i class="fas fa-circle"></i>There are no old diagnoses in this page</h6>
    @endif
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

        window.addEventListener('swal:diagnosisDeleteConfirm', event => {
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
