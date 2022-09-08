<div>
    <div class="row">

        <!-- Start Content-->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <div>
                            <h1 style="display: inline-block;">Doctors List</h1>
                            @if ($flag == 1)
                                <button style="float: right; background-color:#FF5733;" data-toggle="modal"
                                    data-target=".bs-example-modal-lg" class="btn waves-effect waves-light">
                                    <i class="ti-plus mr-1"></i> <span>Add</span> </button>
                            @endif
                        </div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        {{-- <hr> --}}
                        <div class="responsive-table-plugin mt-3">

                            {{-- <div  class="table-rep-plugin"> --}}

                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th data-priority="1">Phone</th>
                                            <th data-priority="3">Email</th>
                                            <th data-priority="1">Image</th>
                                            @if ($flag != 2)
                                                <th data-priority="3">Activation</th>
                                            @endif
                                            <th data-priority="3">Archived</th>
                                            <th data-priority="3">Control</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctors as $index => $doctor)
                                            <tr wire:key="{{ $index }}">
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $doctor->name }} </td>
                                                <td>{{ $doctor->phone }} </td>
                                                <td>{{ $doctor->email }} </td>
                                                <td>
                                                    <img src="{{ URL::asset('storage/' . $doctor->image) }}"
                                                        class="profile-image" width="50" height="50">
                                                </td>
                                                @if ($flag != 2)
                                                    <td>
                                                        @if ($doctor->status == 0)
                                                            <button
                                                                wire:click.prevent="changeStatus({{ $index }})"
                                                                class="btn btn-icon waves-effect waves-light btn-success">
                                                                <i class="ti-check"></i> Active </button>
                                                        @else
                                                            <button
                                                                wire:click.prevent="changeStatus({{ $index }})"
                                                                class="btn btn-icon waves-effect waves-light btn-danger">
                                                                <i class="fas fa-times"></i> deactive</button>
                                                        @endif

                                                    </td>
                                                    <td><button wire:click.prevent="archived({{ $index }})"
                                                            class="btn btn-icon waves-effect waves-light btn-warning">
                                                            <i class="mdi mdi-archive-arrow-down-outline"></i> send to
                                                            archive</button>
                                                    </td>
                                                @else
                                                    <td><button wire:click.prevent="getBack({{ $index }})"
                                                            class="btn btn-icon waves-effect waves-light btn-warning">
                                                            back to system </button>
                                                    </td>
                                                @endif
                                                <td>
                                                    <div class="btn-group ">
                                                        <button type="button"
                                                            class="btn btn-info dropdown-toggle waves-effect"
                                                            data-toggle="dropdown" aria-expanded="false"> <i
                                                                class="fe-settings noti-icon"></i> </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">show
                                                                info</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);"
                                                                wire:click="pre_change_password({{ $index }})"
                                                                class="dropdown-item">change
                                                                password</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">send
                                                                email</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- </div> --}}
                        </div>

                    </div>



                    <!--  Modal content for the above example -->
                    <div wire:ignore.self id="addModal" name="add-modal" class="modal fade bs-example-modal-lg"
                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
                        style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form id="addForm" wire:submit.prevent="add()" role="form" enctype="multipart/form-data">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Add new</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-box">

                                            <div class="form-group">
                                                <label for="doctorName">Name</label>
                                                <input wire:model="name" type="text"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    id="doctorName">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="doctorPhone">Phone</label>
                                                <input wire:model="phone" type="text" class="form-control"
                                                    id="doctorPhone">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="doctorEmail">Email</label>
                                                <input wire:model="email" type="email" class="form-control"
                                                    id="doctorEmail">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="doctorPassword">Password</label>
                                                <input wire:model="password" type="password" class="form-control"
                                                    id="doctorPassword">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="doctorSpecialization">Specialization</label>
                                                <select wire:model="specialization_id" class="form-control"
                                                    id="doctorSpecialization" required>
                                                    @foreach ($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}">
                                                            {{ $specialization->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('specialization_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="doctorImage">Image</label>
                                                <input wire:model="image" type="file" class="form-control"
                                                    id="doctorImage">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button id="btnSave" type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </div><!-- /.modal-content -->
                            </form>
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!--  Modal content for the above example -->
                    <div wire:ignore.self id="changePasswordModal" name="vhange-password-modal"
                        class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form id="changePasswordModalForm" wire:submit.prevent="changePassword()" role="form"
                                enctype="multipart/form-data">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Change Doctor Password</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-box">
                                            <div class="form-group">
                                                <label for="doctorName">New Doctor Password</label>
                                                <input wire:model="newDoctorPassword" type="password" required
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    id="newDoctorPassword">
                                                @error('newDoctorPassword')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="doctorPhone">Admin Password</label>
                                                <input wire:model="adminPassword" type="password" class="form-control"
                                                    required id="adminPassword">
                                                @error('adminPassword')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button id="btnSave" type="submit" class="btn btn-primary">Change</button>
                                    </div>

                                </div><!-- /.modal-content -->
                            </form>
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->

    </div>
</div>


@push('scripts')
    <script>
        window.addEventListener('hide-form', () => {
            $('#addModal').modal('hide');
            $('#updateModal').modal('hide');
            $('#changePasswordModal').modal('hide');
        })
        window.addEventListener('update', event => {
            $('#changePasswordModal').modal('show');
        });
        window.addEventListener('swal:modal', event => { 
            swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            });
        });

    </script>
@endpush
