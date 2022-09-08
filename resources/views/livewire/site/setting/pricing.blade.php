<div>
    <h3 style="text-align: left;color: #EF7000;    padding-top: 23px;">Pricing</h3>
    <form wire:submit.prevent="add()">
        <div class="row mt-2">

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                <form>
                    <label>
                        Title
                        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                    </label>
                    <input wire:model="title" type="text">
                </form>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                <form>
                    <label>
                        Price
                        @error('price') <span class="text-danger">{{ $message }}</span>@enderror
                    </label>
                    <input wire:model="price" type="text">
                </form>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                <button class="done-button" style="width: 135px;height: 35px;border-radius: 30px;" name="answer"
                    value="Show Div" type="submit">Add New</button>

            </div>

        </div>
    </form>
    <h3 style="text-align: left;color: #EF7000;    padding-top: 23px;">Pricing List</h3>

    <div class="table-sec-1 py-4 zui-table zui-table-rounded">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Title</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Price</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pricing as $index => $price)
                    <tr class="tr-body">
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html"> {{ $price->title }} </a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $price->price }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <button wire:click="alertConfirm({{ $index }})"
                                class="btn btn-icon waves-effect waves-light btn-danger">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('swal:confirmPricing', event => {
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
                        window.livewire.emit('removePrice');
                    }
                });
        });
    </script>
@endpush
