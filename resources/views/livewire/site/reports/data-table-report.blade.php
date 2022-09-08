<div>
    <!-- start  patient information sec -->
    <div class="patient-info following-up-sec ">
        <div class="container container-1">
            <h3 class="mt-3" style="text-align: left;color: #6C75E6; font-weight: 600;">Table Reports</h3>
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-4">
                    <form>
                        <label>
                            gender
                        </label>
                        <select wire:model="searchItems.gender">
                            <option selected hidden>choose</option>
                            <option value="3">all</option>
                            <option value="0">male</option>
                            <option value="1">female</option>
                        </select>
                    </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-4">
                    <form>
                        <label>
                            Type
                        </label>
                        <select wire:model="searchItems.type">
                            <option selected hidden>choose</option>
                            <option value="1">all</option>
                            <option value="2">new</option>
                            <option value="3">resumption</option>
                        </select>
                    </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-4">
                    <form>
                        <label>
                            Start Date
                        </label>
                        <input type="date" wire:model="searchItems.startDate" />

                    </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-4">
                    <form>
                        <label>
                            End Date
                        </label>
                        <input type="date" wire:model="searchItems.endDaate" />

                    </form>

                </div>

            </div>

            <div class="footer-sec py-3">
                <div class="row" >
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
                        <div class="media">
                            <img src="{{ URL::asset('assets1/images/2341978.png') }}" class="mr-3" alt="..." >
                            <div class="media-body">
                                <h5 class="mt-3" >Female:<span>{{ $female }}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="media">
                            <img src="{{ URL::asset('assets1/images/4730733.png') }}" class="mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-3">Male:<span>{{ $male }}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="media">
                            <img src="{{ URL::asset('assets1/images/554795.png') }}" class="mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-3">All:<span>{{ $all }}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="media">
                            <img src="{{ URL::asset('assets1/images/891448.png') }}" class="mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-3">New:<span>{{ $new }}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="media">
                            <img src="{{ URL::asset('assets1/images/1594900.png') }}" class="mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-3">Resumption:<span>{{ $resupmtion }}</span></h5>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <!-- start Table-->
            <div class="table-sec-1 py-4 zui-table zui-table-rounded">
                <table style="width: 100%;">
                    <thead>
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
                            Phone</th>
                    </thead>
                    <tbody>
                        @foreach ($patients as $index => $patient)
                            <tr class="tr-body">
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    {{ ($patients->currentPage() - 1) * $patients->links()->paginator->perPage() + $loop->iteration }}
                                </td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a
                                        href="{{ route('doctor.patients.profile', $patient->id) }}">{{ $patient->code }}</a>
                                </td>
                                <td
                                    style="border-right: unset !important; border-left: unset !important;border-top: unset !important;border-bottom:1px solid #dddada !important;">
                                    <a
                                        href="{{ route('doctor.patients.profile', $patient->id) }}">{{ $patient->name }}</a>
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
    <!-- end  patient information sec -->

</div>
