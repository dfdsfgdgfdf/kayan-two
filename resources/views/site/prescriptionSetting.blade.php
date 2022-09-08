@extends('layouts.site.base')
@section('content')

    <!-- start info sec -->
    <div class="info-sec py-1 text-center h-500 center-v center-h w-100" id="outer">
        <button class="button-1 active button_slide slide_left"><a href="{{ Route('doctor.setting') }}"
                class="link-1 active">Setting </a></button>
        <button class="button-1 button_slide slide_left"><a href="{{ Route('doctor.prespiction_setting') }}"
                class="link-3" style="font-size: 12px;">Prescription Settings </a></button>
    </div>
    <!-- end info sec -->


    <!-- start  patient information sec -->
    <div class="patient-info w-100">
        <div class="container container-1">
            {{-- prescription componnent start --}}
            <div>
                @livewire('site.setting.prescription-settings')
            </div>
            {{-- prescription componnent end --}}
        </div>

    </div>
    <!-- end  patient information sec -->


    </div>

@endsection
