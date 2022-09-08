
<div class="w-100">
    <div class="following-up-sec py-4">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h4><i class="fas fa-arrow-up"></i><i class="fas fa-arrow-up"></i>Following Up Patient</h4>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2">
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
            @if (count($books) > 0)
                <!-- start Table-->
                <div class="table-sec-1 py-4 zui-table zui-table-rounded" style='font-family: Georgia; font-size:30px;'>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    #</th>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    Code</th>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    Name</th>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    Gender</th>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    Age</th>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    Examination Date</th>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    Examination Type</th>
                                <th
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    Arrive status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($books))
                                @foreach ($books as $book)
                                    <tr class="tr-body">
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            
                                            {{ ($books->currentPage() - 1)  * $books->links()->paginator->perPage() + $loop->iteration }}
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a>{{ $book->patient->code }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a>{{ $book->patient->name }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a>
                                                @if ($book->patient->gender)
                                                    Female
                                                @else
                                                    Male
                                                @endif
                                            </a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a>{{ $book->patient->age }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            <a>{{ $book->date }}</a>
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            @if ($book->type == 'new')
                                                <a><span style="width: 70%; font-size:large;"
                                                        class=" badge badge-pill badge-success">{{ $book->type }}</span></a>
                                            @else
                                                <a><span style="width: 70%; font-size:large;"
                                                        class=" badge badge-pill badge-warning">{{ $book->type }}</span></a>
                                            @endif
                                        </td>
                                        <td
                                            style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                            @if ($book->arrive_status)
                                                <button wire:click="arriveStatus({{ $book->id }})"
                                                    class="btn btn-icon btn-info"><i class="fas fa-check-circle"
                                                        aria-hidden="true"></i>
                                                </button>
                                            @else
                                                <button wire:click="arriveStatus({{ $book->id }})"
                                                    class="btn btn-icon btn-danger"><i class="fas fa-arrow-alt-circle-down" 
                                                        aria-hidden="true"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
                <!-- end Table-->
            @else
                <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                    <img src="{{ URL::asset('assets1/images/nodata.webp') }}" style="width: 100%;">
                </div>
            @endif

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
        window.addEventListener('show-loder', () => {
            document.getElementById('loder').style.display = "block";
        })

        window.addEventListener('hide-loder', () => {
            document.getElementById('loder').style.display = "none";
        })
    </script>
@endpush
