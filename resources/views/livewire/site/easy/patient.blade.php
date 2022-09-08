<div class="w-100">
    <div class="info-sec py-1 text-center w-100 mb-2">
        <div >
            <button onclick="location.href='{{ route('doctor.easy.patients') }}';" class="button-1 button_slide slide_left "><a
                class="link-1 text-font-times" > Old Patients</a></button>
        </div>
        <div >
            <button onclick="location.href='{{ route('doctor.easy.patient.add') }}';" class="button-1 button-456 button_slide slide_left "><a
                class="link-1 text-font-times" >Add New
                Patient </a></button>
        </div>
    </div>
    <div class="patient-info w-100">
        <!-- start search row -->
        <div class="search-row py-1 text-center">
            <div class="container container-1">
                <div class="container container-1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h4
                                style="color: #6B74E6;padding-top: 26px;font-size: 16px;text-align: left;font-weight: unset;">
                                <i class="fas fa-users" style="padding-right: 10px;"></i>Easy Old Patient List</h4>

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
                    @if (count($patients) > 0)
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
                                </thead>
                                <tbody>
                                    @foreach ($patients as $index => $patient)
                                        <tr class="tr-body">
                                            <td
                                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                                
                                                {{ ($patients->currentPage() - 1)  * $patients->links()->paginator->perPage() + $loop->iteration }}
                                            </td>
                                            <td
                                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                                <a
                                                    href="{{ route('doctor.patients.profile', $patient->id) }}">{{ $patient->code ?? '' }}</a>
                                            </td>
                                            <td
                                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                                <a
                                                    href="{{ route('doctor.patients.profile', $patient->id) }}">{{ $patient->name ?? '' }}</a>
                                            </td>
                                            <td
                                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                                <a href="{{ route('doctor.patients.profile', $patient->id) }}">
                                                    @if ($patient->gender == 0)
                                                        Male
                                                    @else
                                                        Female
                                                    @endif
                                                </a>
                                            </td>
                                            <td
                                                style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                                <a
                                                    href="{{ route('doctor.patients.profile', $patient->id) }}">{{ $patient->phone }}</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- end Table-->
                    @else
                        <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                            <img src="{{ URL::asset('assets1/images/nodata.webp') }}" style="width: 50%;">
                        </div>
                    @endif


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
