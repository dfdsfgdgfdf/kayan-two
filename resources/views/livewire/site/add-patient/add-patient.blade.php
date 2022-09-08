<div>
    <div class="container container-1">
        <h3 style="text-align: left;color: #E62E66;"><i class="fas fa-user"></i>Personal Information</h3>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 mt-4">
                <label>
                    Patient name
                    @error('new_patient.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <input name="name" wire:model="new_patient.name" type="text">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 mt-4">
                <label>
                    age
                    @error('new_patient.age')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <input name="age" wire:model="new_patient.age" type="text">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 mt-4">
                <label>
                    Phone number
                    @error('new_patient.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <input name="phone" wire:model="new_patient.phone" type="text">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 mt-4">
                <label>
                    gender
                    @error('new_patient.gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <select wire:model="new_patient.gender">
                    <option selected hidden>choose</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-4">

                <label>
                    State 
                </label>
                <select wire:model="state">
                    <option selected>choose </option>
                    @foreach ($states as $state)
                        <option value="{{ $state }}">{{ $state }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-4">

                <label>
                    City @error('new_patient.city_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <select wire:model="new_patient.city_id" name="city">
                    <option value="0" selected>choose </option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 mt-4">
                <label>
                    address
                    @error('new_patient.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <input wire:model="new_patient.address" type="text">

            </div>
            

        </div>

        <div id="welcomeDiv1" style="display:none;" class="answer_list">
            <div class="row mt-4">
                <div class="col-xs-12 col-sm-12 col-md-4 mt-2"></div>
                <div  style="box-shadow: 0 -5px 10px -3px rgb(177, 58, 3), 0 5px 10px -3px rgb(177, 58, 3);" class="col-xs-12 col-sm-12 col-md-4 my-3" >
                    <h5 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:18px; background-color:white; ">Code No:<span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size:18px;">{{ $new_patient['code'] ?? '' }}</span></h5>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-xs-12 col-sm-12 col-md-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <button class="done-button" name="answer" value="Show Div" wire:click="add()"
                    style="width: 44%; border-radius: 30px;height: 35px;">Done</button>

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
        window.addEventListener('show-code', () => {
            document.getElementById('welcomeDiv1').style.display = "block";
            document.getElementById('patientData').style.display = "block";
        })
    </script>
@endpush
