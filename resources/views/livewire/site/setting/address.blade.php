<div>
    <h3 style="text-align: left;color: #EF7000;    padding-top: 50px;">Address</h3>


    {{-- show doctor addresses --}}
    <div class="table-sec-1 py-4 zui-table zui-table-rounded">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        State</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        City</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Phone</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Address</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($addresses as $index => $address)


                    <tr class="tr-body">
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $address->city->state }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $address->city->name }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $address->phone }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $address->address }} </a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <button wire:click="alertConfirm({{ $index }})"
                                class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 style="text-align: left;color: #EF7000;    padding-top: 50px;">Add New Address</h3>

        <form wire:submit.prevent="add()">
            <div class="row field_wrapper mt-3">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">

                    <label>
                        State
                        @error('state') <span class="text-danger">{{ $message }}</span>@enderror
                    </label>
                    <select wire:model="state" name="state">
                        <option value="0" selected>choose </option>
                        @foreach ($states as $single_state => $state)
                            <option value="{{ $state }}">{{ $state }} </option>
                        @endforeach
                    </select>


                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">

                    <label>
                        City @error('city_id') <span class="text-danger">{{ $message }}</span>@enderror
                    </label>
                    <select wire:model="city_id" name="city">
                        <option value="0" selected>choose </option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">

                    <label>
                        Phone Number
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </label>
                    <input wire:model="phone" type="text" name="phone" value="">


                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 mt-9">

                    <label>
                        Address
                        @error('address') <span class="text-danger">{{ $message }}</span>@enderror
                    </label>
                    <input class="mt-3" wire:model="address" type="text" name="address">


                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-3"></div> --}}
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-3 form-group">
                    <button class="done-button  add_button" title="Add field" id="demo"
                        style="width: 135px;height: 35px;border-radius: 30px;" name="answer" type="submit">Save</button>

                </div>

            </div>
        </form>

    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                timer: 1000
            });
        });
        window.addEventListener('swal:confirmAddress', event => {
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
                        window.livewire.emit('removeOneAddress');
                    }
                });
        });
    </script>
@endpush
