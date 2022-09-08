<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <h1>Message Info</h1>
                <hr>
                <h4 class="header-title">From :
                    @if ($message->sender_type == 1)
                        {{ $message->sender_admin->name }}
                    @else
                        {{ $message->sender_doctor->name }}
                    @endif
                </h4>
                <h4 class="header-title">To :
                    @if ($message->receiver_type == 1)
                        {{ $message->receiver_admin->name }}
                    @else
                        {{ $message->receiver_doctor->name }}
                    @endif
                </h4>
                <h4 class="header-title">Title : {{ $message->title }}</h4>
                <h4 class="header-title">Content : </h4>
                <p class=" font-13">
                    {{ $message->content }}
                </p>

            </div>
        </div><!-- end col -->
    </div>
</div>
