<div>
    <div class="patient-info ">
        <div class="container container-1">
            <h6 style="color: #6B74E6;padding-top: 26px;font-size: 16px;text-align: left;font-weight: unset;"> <i
                    class="fas fa-users-cog" style="padding-right: 10px;"></i>Changing Your Password</h6>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 my-4">
                    <form>
                        <label>
                            New Password
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                        
                        <input type="password" wire:model="password">
                    </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 my-4">

                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 my-4">
                    <div class="form-row text-center">
                        <div class="col-12">
                            <form  id="changeForm" wire:submit.prevent="changePassword()" enctype="multipart/form-data">
                                <button class="btn save-button" style="width:180px; height: 42px;border-radius: 30px;"
                                    class="btn btn-info btn-lg" type="submit"> Save</button>
                            </form>
                        </div>
                     </div>
                </div>

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
@endpush