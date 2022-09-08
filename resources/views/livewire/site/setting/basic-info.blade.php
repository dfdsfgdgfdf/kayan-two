<div>
    <h6 style="color: #6B74E6;padding-top: 26px;font-size: 16px;text-align: left;font-weight: unset;"> <i
            class="fas fa-users-cog" style="padding-right: 10px;"></i>Changing Your Settings</h6>
    <h3 style="text-align: left;color: #EF7000;">Basic Info</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <form>
                <label>
                    Name
                </label>
                <input wire:model="doctor.name" type="text" value="{{ $doctor->name }}">
            </form>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <form>
                <label>
                    Phone number
                </label>
                <input wire:model="doctor.phone" type="text" value="{{ $doctor->phone }}">
            </form>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <form>
                <label>
                    Email
                </label>
                <input wire:model="doctor.email" type="email" value="{{ $doctor->email }}">
            </form>

        </div>
        <div class="upload-profile-pic py-4 w-100">
            
        </div>

    </div>
    <div class="line-sec-4 py-4">
        <div class="container-fluid">
            <div class="line-4">
                <h6>Profile Picture</h6>

            </div>


        </div>

    </div>

    <div class="upload-image1">
        <div class="upload-profile-pic py-4">
            <img class="profile-pic" src="{{ URL::asset('storage/' . $doctor->image) }}" />

            <div class="p-image">
                <i class="fa fa-camera upload-button"></i>
                <input wire:model="image" type="file" accept="image/*" class="file-upload" id="image" />
            </div>
        </div>
    </div>


    <hr>
    @livewire('site.setting.address')
    <hr>

    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-12 mt-3">
                <label>
                    Specialization
                </label>
                <select id="selectSpecialization" wire:model="doctor.specialization_id">
                    @foreach ($specializations as $index => $specialization)
                        <option  value="{{ $specialization->id }}">
                            {{ $specialization->name }}</option>
                    @endforeach
                </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">
            <label>
                new price
            </label>
            <input wire:model="doctor.new_cost" type="text" value="{{ $doctor->new_cost }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">
            <label>
                resumption price
            </label>
            <input wire:model="doctor.resumption_cost" type="text" value="{{ $doctor->resumption_cost }}">
        </div>
    </div>
    {{-- <h3 style="text-align: left;color: #EF7000;    padding-top: 23px;  width:100%;">Curriculum</h3>
    <div class="text-editor-setting w-100">
        <div class="row mt-4 mb-4 w-100">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="sample-toolbar clearfix mb20">
                    <a href="javascript:void(0)" onclick="format('bold')"><span class="fa fa-bold fa-fw"></span></a>
                    <a href="javascript:void(0)" onclick="format('italic')"><span class="fa fa-italic fa-fw"></span></a>
                    <a href="javascript:void(0)" onclick="format('insertunorderedlist')"><span
                            class="fa fa-list fa-fw"></span></a>
                    <a href="javascript:void(0)" onclick="setUrl()"><span class="fa fa-link fa-fw"></span></a>
                    <span><input id="txtFormatUrl" placeholder="url" class="form-control"></span>
                </div>

                <div class="editor" id="sampleeditor">
                    <form>
                        <textarea></textarea>
                    </form>
                </div>

            </div>


        </div>
    </div> --}}

    <hr>
    @livewire('site.setting.pricing')
    <hr>
    @livewire('site.setting.schedule')
    <hr>

    <h6 style="text-align: left;color: #EF7000;padding-top: 23px;">Who Can See The Patient Diagnosis:</h6>
    <div class="checkbox-sec mt-3 mb-3">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <input wire:model="doctor.diagnosis_availability" type="radio" id="vehicle1" name="See" value="0"
                        style="height: unset  !important;; background: unset;border:unset; border-radius: unset;width: unset;position: unset;">
                    <label for="vehicle1"
                        style="position: unset;z-index: unset;left: unset;bottom: unset; background: unset;font-size: unset; color: #848282; ">
                        Available For The Patient Only</label><br>
                    <input wire:model="doctor.diagnosis_availability" type="radio" id="vehicle2" name="See" value="1"
                        style=" height: unset  !important;background: unset;border:unset; border-radius: unset;width: unset;position: unset;">
                    <label for="vehicle2"
                        style="position: unset;z-index: unset;left: unset;bottom: unset; background: unset;font-size: unset; color:#848282; ">
                        Available For The Doctors Only</label><br>
                    {{-- <input type="radio" id="vehicle3" name="See" value="Boat"
                        style=" height: unset  !important;background: unset;border:unset; border-radius: unset;width: unset;position: unset;">
                    <label for="vehicle3"
                        style="position: unset;z-index: unset;left: unset;bottom: unset; background: unset;font-size: unset; color:#848282; ">
                        Available For Only One Doctor :</label><br><br>
                    <label>Doctor name</label>
                    <input type="text"> --}}


            </div>

            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <h2 style="font-size: 16px; padding: 10px 16px;color: #747474;">Can The Doctor Accept To
                        Do Online Check Ups:</h2>
                    <div class="last-sec py-4">
                        <div class="row">
                            <div class="col">
                                <label class="switch">
                                    <input wire:model="doctor.online_check_ups" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <h2 style="font-size: 16px; padding: 10px 16px;color: #747474;">Can The Doctor Accept To
                        Do Online Chat:</h2>
                    <div class="last-sec py-4">
                        <div class="row">
                            <div class="col">
                                <label class="switch">
                                    <input wire:model="doctor.online_chat" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <h2 style="font-size: 16px; padding: 10px 16px;color: #747474;">Can The Assistant See All
                        The Dashboard:</h2>
                    <div class="last-sec py-4">
                        <div class="row">
                            <div class="col">
                                <label class="switch">
                                    <input wire:model="doctor.dashboard_availability"  type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>


    </div>
    <div class="form-row text-center">
        <div class="col-12">
            <form  id="changeForm" wire:submit.prevent="update()" enctype="multipart/form-data">
                <button class="btn save-button" style="width:180px; height: 42px;border-radius: 30px;"
                    class="btn btn-info btn-lg" type="submit"> Save</button>
            </form>
        </div>
     </div>

</div>



@push('scripts')
    <script>
        $(document).ready(function() {

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
    </script>
@endpush
