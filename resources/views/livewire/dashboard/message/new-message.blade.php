<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <h3 class="header-title mt-0 mb-3">New Message</h3>
                <hr>

                <form action="#" data-parsley-validate="" novalidate="">
                    <div class="form-group">
                        <label for="userName">Send To:</label>
                        @error('new_message.receiver_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <select wire:model="new_message.receiver_id" class="form-control" required>
                            <option value="0">Choose</option>
                            @foreach ($doctors as $doctor )
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Title</label>
                        @error('new_message.title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input wire:model="new_message.title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pass1">Content</label>
                        @error('new_message.content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <textarea wire:model="new_message.content" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="form-group text-right mb-0">
                        <button class="btn btn-primary waves-effect waves-light mr-1"  wire:click="send()">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- end col -->

    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('swal:modal', event => { 
            swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            });
        });
    </script>
@endpush