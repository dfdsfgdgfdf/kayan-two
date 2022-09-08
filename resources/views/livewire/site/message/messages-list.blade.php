<div>
    <!-- start info sec -->
    <div class="info-sec-1 py-1 text-center">
        <div class="row">
            <div class="col-xs-12 col-xs-12 col-md-6 mt-2">
                <button class="button-1 button_slide slide_left"> <a href="{{ route('doctor.messages.list', 1) }}">
                        Reserved Messages</a></button>

            </div>
            <div class="col-xs-12 col-xs-12 col-md-6 mt-2">
                <button class="button-1 button_slide slide_left"><a href="{{ route('doctor.messages.list', 2) }}">Sent
                        Messages</a> </button>
            </div>

        </div>

    </div>
    <!-- end info sec -->
    <!-- start following-up sec -->
    <div class="following-up-sec py-4">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <a href="{{ route('doctor.messages.send') }}" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
                    <h4 class="mx-2" style="display:inline; color: #6D78FF;">Messages List: </h4>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-outline">
                        <input type="search" id="form1" wire:model="searchItem" class="form-control"
                            placeholder="Searching Here" aria-label="Search" />
                        <div class="mt-1" wire:loading>Searching ...</div>
                        <div wire:loading.remove></div>
                    </div>
                </div>
                
            </div>
            <hr>
            <div id="loder" class="loading style-2" style="display: none;">
                <div class="loading-wheel">
                </div>
            </div>
            <!-- start Table-->
            <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                <table style="width: 100%;">
                    <thead>
                        <th
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important; color: #E62E66;">
                            @if ($type == 1)
                                Sender
                            @else
                                Reciver
                            @endif
                            Name
                        </th>
                        <th
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important; color: #E62E66;">
                            Message Title</th>
                            <th
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important; color: #E62E66;">
                            Read</th>
                        <th
                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;color: #E62E66;">
                            Date</th>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr class="tr-body">
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    @if ($type == 1)
                                        @if ($item->sender_type == 1)
                                            Admenistration
                                        @else
                                            {{ $item->sender_id }}
                                        @endif
                                    @else
                                        @if ($item->receiver_type == 1)
                                            Admenistration
                                        @else
                                            {{ $item->receiver_id }}
                                        @endif
                                    @endif
                                </td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a href="{{ route('doctor.messages.info', $item->id) }}">{{ $item->title }}</a>
                                </td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a href="{{ route('doctor.messages.info', $item->id) }}">{{ $item->read_status ? 'yes' : 'no' }}</a>
                                </td>

                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a href="{{ route('doctor.messages.info', $item->id) }}">{{ $item->created_at }}</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- end Table-->
             <!-- start paganition page  -->
             <div class="table-sec-1">
                <div class="paganition-sec py-4 text-center">
                    <div class="row " style="display: inline-block; justify-content: center;">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-12">
                            <ul class="pagination">
                                {{ $list->onEachSide(1)->links() ?? '' }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end paganition page  -->

        </div>

    </div>

    <!-- end following-up sec -->
</div>
