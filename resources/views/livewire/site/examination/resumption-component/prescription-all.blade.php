<div>
    @if (count($books) > 0)
        @foreach ($books as $book)
            <div class="patient-sec-66">
                <div class="container cont-88" style="background: white;border-radius: 15px;">
                    <div class="row mt-3 py-4">
                        <div class="  col-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <h3 style="color: #6C75E6;  ">Prescription </h3>
                                </div>
                                <div class="col-md-5 ">
                                    <label class="mt-2" style="color: #6C75E6; ">Date: </label> <label
                                        style="overflow-wrap:break-word;" class="ml-1">
                                        {{ $book->date }}</label>
                                </div>
                                <div class=" col-md-2">
                                    {{-- @livewire('site.prescription.modal',['book_id' => $book->id], key($book->id)) hey{{ $book->id }} --}}
                                    {{-- <div class="wrap">
                                        <button wire:click="$emit('refreshModal', {{  $book->id ?? '' }})" type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#MyModal{{ $book->id ?? '' }}">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div> --}}
                                    <button wire:click="showModel({{ $book->id }})" type="button" class="btn btn-primary" >
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if ($book['diagonse'])
                            <div class="d-flex  col-12">
                                <div class="col-md-9">
                                    <h6 style="color: #6C75E6; ">Daignosis Info: </h6>
                                </div>
                            </div>
                            <div class="d-flex  col-12">
                                <div class="col-md-12">
                                    <label
                                        style="display: inline-block;
                                    word-break: break-word;"
                                        class="ml-1">
                                        {{ $book['diagonse']->content ?? '' }}</label>
                                </div>
                            </div>
                        @endif

                        @if (count($book['prescriptions']) > 0)
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <h6 style="color: #6C75E6;" class="Prescription-Details">Prescription Details: </h6>
                                    <ul class="ml-3">
                                        @foreach ($book['prescriptions'] as $prescriptions)
                                            <li class="li-ul-all">
                                                {{ $prescriptions->medicine->name }}
                                                @if ($prescriptions->dose != '')
                                                    -
                                                @endif
                                                {{ $prescriptions->dose }}

                                                @if ($prescriptions->time != '')
                                                    -
                                                @endif
                                                {{ $prescriptions->time }}

                                                @if ($prescriptions->note != ' ')
                                                    -
                                                @endif
                                                {{ $prescriptions->note }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (count($book['medicalRadiologies']) > 0)
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <h6 style="color: #6C75E6;">Medical Radiology Details: </h6>
                                    <ul class="ml-3">
                                        @foreach ($book['medicalRadiologies'] as $medicalRadiology)
                                            <li class="li-ul-all">{{ $medicalRadiology->name }}
                                                @if($medicalRadiology->note != ' ') 
                                                -
                                                @endif
                                                {{ $medicalRadiology->note }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (count($book['medicalTests']) > 0)
                            <div class="row ml-2">
                                <div class="col-md-12">
                                    <h6 style="color: #6C75E6;">Medical Test Details: </h6>
                                    <ul class="ml-3">
                                        @foreach ($book['medicalTests'] as $medicalTest)
                                            <li class="li-ul-all">{{ $medicalTest->name }} 
                                                @if($medicalTest->note != ' ') 
                                                -
                                                @endif
                                                {{ $medicalTest->note }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach


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
    @else
        <h6><i class="fas fa-circle"></i>There are no old prescription in this page</h6>


    @endif

    <!-- start modal -->
    <div id="printThis">
        <div id="MyModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">

                <!-- Modal Content: begins -->
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button> --}}
                        
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body modal-body33">
                        <div class="body-message">
                            <!--  start header -->
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="img-pres-logo">
                                        @if (isset($all_prescription_setting->logo))
                                            <img src="{{ URL::asset('storage/' . $all_prescription_setting->logo) }}"
                                                style="width: 150px; height: 120px">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                    <p style="display: flex;
                                    justify-content: center;" class="doctor-name-pres">{{ $all_prescription_setting->name ?? '' }}</p>
                                    <p style="display: flex;
                                    justify-content: center;" class="doctor-specialist-pres">
                                        {{ $all_prescription_setting->specialization ?? '' }}</p>
                                    <p style="display: flex;
                                    justify-content: center;" class="doctor-specialist-pres">
                                        {{ $all_prescription_setting->description ?? '' }}</p>

                                </div>
                            </div>
                            <div class="line-pres"></div>
                            <!--  end header -->
                            <!-- start patient info pres -->
                            <div class="patient-info-pres py-2 px-2">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg">

                                        <p class="patient-info-p">Date:<span>{{ $all_book->date ?? '' }}</span></p>


                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg">
                                        <p class="patient-info-p">Age:<span>{{ $all_book->patient->age ?? '' }}</span>
                                        </p>

                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg">
                                        <p class="patient-info-p">Gender:<span>
                                                @if ($all_book->patient->gender ?? '')
                                                    Female
                                                @else
                                                    Male
                                                @endif
                                            </span></p>

                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg">
                                        <p class="patient-info-p">
                                            Name:<span>{{ $all_book->patient->name ?? '' }}</span></p>

                                    </div>


                                </div>

                            </div>
                            <div class="line-pres"></div>
                            <!-- end patient info pres -->
                            <!-- start medical pres -->
                            <div class="medical-pres py-3 mt-4 px-2">
                                {{-- @if ($all_diagonse)
                                    <div class="medical-drugs text-left">
                                        <h4 class="title-med-pres">Daignosis Info</h4>
                                        <p class="med-drugs"><i class="fa fa-circle"
                                                aria-hidden="true"></i>{{ $all_diagonse->content ?? '' }}</p>
                                    </div>
                                @endif --}}
                                @if (count($all_prescriptions) > 0)
                                    <div class="medical-drugs text-left">

                                        <h4 class="title-med-pres">Prescription Details</h4>
                                        @foreach ($all_prescriptions as $index => $prescription)
                                            <p class="med-drugs"><i class="fa fa-circle" aria-hidden="true"></i>
                                                {{ $prescription->medicine->name }}
                                                @if ($prescription->dose != '')
                                                    -
                                                @endif
                                                {{ $prescription->dose }}

                                                @if ($prescription->time != '')
                                                    -
                                                @endif
                                                {{ $prescription->time }}

                                                @if ($prescription->note != ' ')
                                                    -
                                                @endif
                                                {{ $prescription->note }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                                {{-- @if (count($all_medicalRadiology) > 0)
                                    <div class="medical-drugs text-left">

                                        <h4 class="title-med-pres">Medical Radiology Details</h4>
                                        @foreach ($all_medicalRadiology as $index => $data)
                                            <p class="med-drugs"><i class="fa fa-circle" aria-hidden="true"></i>
                                                {{ $data->name }}
                                                @if ($data->note != ' ')
                                                    -
                                                @endif
                                                {{ $data->note }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                                @if (count($all_medicalTest) > 0)
                                    <div class="medical-drugs text-left">

                                        <h4 class="title-med-pres">Medical Test Details</h4>
                                        @foreach ($all_medicalTest as $index => $data)
                                            <p class="med-drugs"><i class="fa fa-circle" aria-hidden="true"></i>
                                                {{ $data->name }}
                                                @if ($data->note != ' ')
                                                    -
                                                @endif
                                                {{ $data->note }}
                                            </p>
                                        @endforeach

                                    </div>
                                @endif --}}
                                <div class="doctor-Signature py-1">
                                    @if (isset($all_prescription_setting->seal))
                                        <img src="{{ URL::asset('storage/' . $all_prescription_setting->seal) }}"
                                            style="width: 200px;height: 100px;">
                                    @endif
                                </div>
                            </div>
                            <div class="line-pres"></div>
                            <!-- end medical pres -->
                            <!-- start contact pres -->
                            <div class="contact-pres py-2 px-2 text-center">
                                <p class="contact-pres-p"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    {{ $all_prescription_setting->address->city->state ?? '' }} -
                                    {{ $all_prescription_setting->address->city->name ?? '' }} -
                                    {{ $all_prescription_setting->address->address ?? '' }}
                                </p>
                                <p class="contact-pres-p"><i class="fa fa-phone-square"
                                        aria-hidden="true"></i>{{ $all_prescription_setting->phone ?? '' }}</p>
                            </div>
                            <!-- end contact pres -->
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button id="btnPrint" type="button" class="btn btn-default">Print</button>
                    </div>

                </div>
                <!-- Modal Content: ends -->

            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        window.addEventListener('show-model', () => {
            $('#MyModal').modal('show');
        })
    </script>
@endpush
