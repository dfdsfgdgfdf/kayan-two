<div>
    <div class="sender-details-sec py-4">
        <div class="container">
            <!-- start sender info -->
            <div class="sender-info">
                <div class="container ">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <ul>
                                <li>
                                    <p><i class="far fa-envelope"></i> <span class="span-msg">Message Title:</span>
                                        {{ $message->title }}</p>
                                </li>
                                <li>
                                    <p><i class="fas fa-user-circle"></i> <span class="span-msg">From:</span>
                                        @if ($message->sender_type == 1)
                                            Admenistration
                                        @else
                                            {{ $message->sender_doctor->name }}
                                        @endif
                                    </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-user-circle"></i> <span class="span-msg">To:</span>
                                        @if ($message->receiver_type == 1)
                                            Admenistration
                                        @else
                                            {{ $message->receiver_doctor->name }}
                                        @endif
                                    </p>
                                </li>



                                <li>
                                    <p><i class="far fa-calendar-alt"></i> <span
                                            class="span-msg">Date:</span>{{ $message->created_at }}
                                    </p>
                                </li>
                            </ul>

                        </div>

                    </div>

                </div>


            </div>
            <!-- end sender info -->
            <!-- start paraghraph  -->
            <div class="para-msg-sec py-4">
                <div class="container container-99">
                    <p>
                        {{ $message->content }}
                    </p>

                </div>

            </div>
            <!-- end paragraph -->
        </div>

    </div>
    <!-- end sender details sec -->
</div>
