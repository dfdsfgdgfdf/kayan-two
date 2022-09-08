<div class="w-100">
    <div class="patient-info w-100">
        <!-- start search row -->
        <div class="search-row py-1 text-center">
            <div class="container container-1">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h4 style="color: #6B74E6;padding-top: 26px;font-size: 16px;text-align: left;font-weight: unset;"> <i
                            class="fas fa-users" style="padding-right: 10px;"></i>Patients List</h4>
    
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                        <div class="form-outline">
                            <input type="search" id="form1"  wire:model="searchItem" class="form-control" placeholder="Searching Here" aria-label="Search" />
                            <div class="mt-1" wire:loading>Searching ...</div>
                            <div wire:loading.remove></div>
                        </div>
                    </div>
    
                </div><hr>
                <!-- start Table-->
                <div class="table-sec-1 py-4 zui-table zui-table-rounded" style='font-family: Georgia; font-size:30px;'>
                    <table style="width: 100%;">
                        <thead>
                            <th
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important; ">
                                # </th>
                            <th
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important; ">
                                Code </th>
                            <th
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important; ">
                                Name</th>
                            <th
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                Gender</th>
                            <th
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                Phone</th>
                            <th
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                Type</th>
                        </thead>
                        <tbody>
                            @foreach ( $patients as $index => $patient )
                            <tr class="tr-body">
                                <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                {{ ($patients->currentPage() - 1)  * $patients->links()->paginator->perPage() + $loop->iteration }}</td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    {{ $patient->code }}</td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a href="{{ route('doctor.patients.profile', $patient->id) }}">{{ $patient->name ?? '' }}</a>
                                </td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a href="{{ route('doctor.patients.profile', $patient->id) }}">@if(  $patient->gender == 0) Male @else Female @endif </a>
                                </td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a href="{{ route('doctor.patients.profile', $patient->id) }}">{{ $patient->phone }}</a>
                                </td>
                                <td
                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                <a href="{{ route('doctor.patients.profile', $patient->id) }}">@if($patient->easy) Easy @else Normal @endif</a>
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
                                    {{ $patients->onEachSide(1)->links() ?? '' }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end paganition page  -->

            </div>

        </div>
    </div>
</div>
