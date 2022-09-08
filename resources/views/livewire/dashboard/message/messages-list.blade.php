<div>
    <div class="row">

        <!-- Start Content-->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <div>
                            <h1 style="display: inline-block;">Messages List</h1>
                        </div>
                        {{-- @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif --}}
                        <hr>
                        <div class="responsive-table-plugin mt-3">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>read</th>
                                            <th>Show</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->id }} </td>
                                                <td>{{ $item->title }} </td>
                                                <td>{{ $item->created_at }} </td>
                                                <td>{{ $item->read_status ? 'yes' : 'no' }} </td>
                                                <td>
                                                    <a style="background-color:#2a62ee;"
                                                        href="{{ route('dashboard.messages.info', $item->id) }}" class="btn waves-effect waves-light">
                                                       <span style="color: white">Show Message</span> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->

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
