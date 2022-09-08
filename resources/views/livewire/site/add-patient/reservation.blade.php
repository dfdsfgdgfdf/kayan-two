<div>
    @if ($patient_id)
    <h4 class="p-3" style="text-align: left;color: #6B74E6;margin-top: 15px;  "><img
            src="{{ URL::asset('assets1/images/7503208_bill_invoice_receipt_icon.png') }}"
            style="width: 20px; margin-right: 10px;">Bill Cost</h4>
    <div class="row p-3">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Examination Date
                @error('new_reservation.date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input id="datepicker" type="date" wire:model="new_reservation.date">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Time
                @error('new_reservation.time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input type="time" wire:model="new_reservation.time">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Type
                @error('new_reservation.type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <select wire:model="new_reservation.type">
                <option selected="" hidden=""></option>
                <option value="new">New</option>
                <option value="resumption">Resumption</option>
            </select>
        </div>

    </div>
    <div class="row mt-2 p-3">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Cost
                @error('new_reservation.cost')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input type="number" wire:model="new_reservation.cost">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Discount
                @error('new_reservation.discount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input type="number" wire:model="new_reservation.discount" placeholder="%">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Final Cost
                @error('new_reservation.final_cost')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input type="number" wire:model="new_reservation.final_cost">
        </div>

    </div>
    <div class="row mt-4 mb-4 p-3">
        <div class="col-xs-12 col-sm-12 col-md-4"></div>
        <div class="col-xs-12 col-sm-12 col-md-4"></div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <button class="done-button" name="answer" value="Show Div" wire:click="reservation()"
                style="width: 44%; border-radius: 30px;height: 35px;">Reserve</button>
        </div>

    </div>
    @endif
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
    </script>

@endpush
