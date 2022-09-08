<div>
    <div class="row">

        <!-- Start Content-->
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <div>
                            <h1 style="display: inline-block;">Specialization List</h1>
                            
                                <button style="float: right; background-color:#FF5733;" data-toggle="modal"
                                    data-target=".bs-example-modal-lg" class="btn waves-effect waves-light">
                                    <i class="ti-plus mr-1"></i> <span>Add</span> </button>
                           
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
                                            <th data-priority="3">update</th>
                                            <th data-priority="3">delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($specializations as $index => $specialization)
                                            <tr wire:key="{{ $index }}">
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $specialization->name }} </td>
                                                <td>
                                                    <button
                                                    wire:click.prevent="re_update({{ $index }})"
                                                    class="btn btn-icon waves-effect waves-light btn-warning">
                                                    <i class="fe-edit"></i> </button>

                                                </td>
                                                <td><button wire:click="alertConfirm({{ $index }})"
                                                        class="btn btn-icon waves-effect waves-light btn-danger">
                                                        <i class="fe-trash-2"></i></button>
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
                            <form id="addForm" wire:submit.prevent="add()" role="form"
                                enctype="multipart/form-data">

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
                                                    id="doctorName" required>
                                                @error('name') <span
                                                    class="text-danger">{{ $message }}</span>@enderror
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


                    {{-- update --}}
                    <div wire:ignore.self id="updateModal" name="add-modal" class="modal fade bs-example-modal-lg"
                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
                        style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form id="addForm" wire:submit.prevent="update({{ $updateIndex }})" role="form"
                                enctype="multipart/form-data">

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
                                                    id="doctorName" required>
                                                @error('name') <span
                                                    class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button id="btnSave" type="submit" class="btn btn-primary">Update</button>
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
        window.addEventListener('update', event => { 
            $('#updateModal').modal('show');
        });
        window.addEventListener('swal:modal', event => { 
            swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            });
        });

        window.addEventListener('swal:confirm', event => { 
            swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            showCancelButton: true,
            dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    window.livewire.emit('remove');
                }
            });
        });
    </script>
@endpush