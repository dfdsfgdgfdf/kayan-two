<div>
    <div>
        <div class="sender-details-sec py-4">
            <div class="container">
                <!-- start sender info -->
                <div class="sender-info">
                    <div class="container ">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="mx-2" style="display:inline; color: #6D78FF;">New Messages: </h4>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <ul>
                                    <li>
                                        <p><i class="fas fa-user-circle"></i> <span class="span-msg">To:</span>
                                            @error('new_message.receiver_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <select wire:model="new_message.receiver_id" class="form-control" required>
                                                <option value="0">Choose</option>
                                                <option value="1">Adminstration</option>
                                            </select>
                                        </p>
                                    </li>
                                    <li>
                                        <p><i class="far fa-envelope"></i>
                                            <span class="span-msg">Title:</span>
                                            @error('new_message.title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <input wire:model="new_message.title" class="form-control">
                                        </p>
                                    </li>
                                    <li>
                                        <p><i class="far fa-envelope"></i> <span class="span-msg">Content:</span>
                                            @error('new_message.content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <textarea wire:model="new_message.content" class="form-control" rows="5"></textarea>
                                        </p>
                                    </li>

                                </ul>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <button href="{{ route('doctor.messages.send') }}"
                                    style="display:inline; color: #fafafa; background-color:#6D78FF; border-color: #6D78FF;"
                                    type="button" class="form-control btn btn-info" wire:click="send()">Send</button>

                            </div>

                        </div>

                    </div>


                </div>
                <!-- end sender info -->
            </div>

        </div>
        <!-- end sender details sec -->
    </div>

</div>
@push('scripts')
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                timer: 1000,
            });
        });
    </script>
@endpush