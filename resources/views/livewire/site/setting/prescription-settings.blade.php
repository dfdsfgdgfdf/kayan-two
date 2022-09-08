<div>
    <h6 style="color: #6B74E6;padding-top: 26px;font-size: 16px;text-align: left;font-weight: unset;"> <i
            class="fas fa-users-cog" style="padding-right: 10px;"></i>Changing Prescription Settings</h6>
    <h3 style="text-align: left;color: #EF7000;">Doctor Info</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Name
            </label>
            <input wire:model="prescription_setting.name" type="text" value="{{ $prescription_setting->name }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
            <label>
                Specialization
            </label>
            <input wire:model="prescription_setting.specialization" type="text"
                value="{{ $prescription_setting->specialization }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">

            <label>
                Phone
            </label>
            <input wire:model="prescription_setting.phone" type="text" value="{{ $prescription_setting->phone }}">


        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-12 mt-3">

            <label>
                address
            </label>
            <select wire:model="prescription_setting.address_id" name="address">
                <option value="0" selected>choose </option>
                @foreach ($addresses as $single_addresses => $address)
                    <option value="{{ $address->id }}">{{ $address->city->state }} - {{ $address->city->name }} -
                        {{ $address->address }} </option>
                @endforeach
            </select>


        </div>
        <div class="col-x-12 col-sm-12 col-md-12 mt-3 ">
            <textarea wire:model.defer="prescription_setting.description">{{ $prescription_setting->description }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-x-6 col-sm-6 col-md-6 mt-3">
            <div class="line-sec-4 py-4">
                <div class="container-fluid">
                    <div class="line-4">
                        <h6>Logo</h6>

                    </div>
                </div>
            </div>
            <div class="upload-image1">
                <form>
                    <!--  -->
                    <div class="upload-profile-pic py-4">
                        <img class="profile-pic-1"
                            src="{{ URL::asset('storage/' . $prescription_setting->logo) }}" />
                        <div class="p-image">
                            <i class="fa fa-camera upload-logo"></i>
                            <input wire:model="logoImage" class="file-upload-1" type="file" accept="image/*" />
                        </div>


                    </div>
                    <!--  -->
                </form>
            </div>
        </div>
        <div class="col-x-6 col-sm-6 col-md-6 mt-3">
            <div class="line-sec-4 py-4">
                <div class="container-fluid">
                    <div class="line-4">
                        <h6>Seal</h6>

                    </div>
                </div>
            </div>
            <div class="upload-image1">
                <form>
                    <!--  -->
                    <div class="upload-profile-pic py-4">
                        <img class="profile-pic-1"
                            src="{{ URL::asset('storage/' . $prescription_setting->seal) }}" />
                        <div class="p-image">
                            <i class="fa fa-camera upload-seal"></i>
                            <input wire:model="sealImage" class="file-upload-2" type="file" accept="image/*" />
                        </div>


                    </div>
                    <!--  -->
                </form>
            </div>
        </div>
    </div>

    <div class="save-sec-1 mt-4 py-3">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <button class="save-button" style="width: 100%; height: 42px;border-radius: 30px;" type="button"
                    class="btn btn-info btn-lg" wire:click="update()"> Save</button>
            </div>

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
    </script>
    <script>
        $(document).ready(function() {

            $(".upload-logo").on('click', function() {
                $(".file-upload-1").click();
            });
            $(".upload-seal").on('click', function() {
                $(".file-upload-2").click();
            });
        });
    </script>
@endpush
