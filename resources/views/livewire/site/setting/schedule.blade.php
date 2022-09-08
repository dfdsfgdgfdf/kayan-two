<div>
    <h3 style="text-align: left;color: #EF7000;    padding-top: 23px;">Schedule</h3>
    <form wire:submit.prevent="add()">

    <div class="row mt-2">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <form>
                <select wire:model="day" required name="day">
                    <option value="0">Saturday</option>
                    <option value="1">Sunday</option>
                    <option value="2">Monday</option>
                    <option value="3">Tuesday</option>
                    <option value="4">Wednesday</option>
                    <option value="5">Thursday</option>
                    <option value="6">Friday</option>
                </select>
            </form>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <div class="row">
                <div class="col">
                    <form>

                        <input wire:model="start" type="time">
                    </form>
                </div>
                <div class="col">
                    <form>

                        <input wire:model="end" type="time">
                    </form>
                </div>

            </div>


        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <button class="done-button" style="width: 135px;height: 35px;border-radius: 30px;" name="answer"
                value="Show Div" type="submit">Add New</button>
        </div>
    </div>
    </form>

    <h3 style="text-align: left;color: #EF7000;    padding-top: 23px;">Schedule List</h3>
    <div class="table-sec-1 py-4 zui-table zui-table-rounded">

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Day</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Start</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        End</th>
                    <th
                        style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                        Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $index => $schedule )
                    <tr class="tr-body">
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $schedule->day }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $schedule->start }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <a href="following up details.html">{{ $schedule->end }}</a>
                        </td>
                        <td
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                            <button wire:click="alertConfirm({{ $index }})" class="btn btn-icon waves-effect waves-light btn-danger"> <i
                                    class="fas fa-times"></i>
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
        window.addEventListener('swal:confirm', event => {
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
                        window.livewire.emit('removeSchedule');
                    }
                });
        });
    </script>
@endpush
