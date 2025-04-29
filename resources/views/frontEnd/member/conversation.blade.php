@extends('frontEnd.layouts.master')
@section('title', '')
@section('css')
    <style>
        .scrolltop {
            display: none;
        }
    </style>
@endsection
@section('content')
    @include('frontEnd.layouts.navigation')
    <div class="message-popup-inner">
        <div class="message-popup-header">
            <div class="left">
                <div class="back">
                    <a href="{{ route('member.messages') }}" class="message-back-button">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
                <div class="image">
                    <img src="{{ asset($conversationMemberImage ?? '') }}">
                </div>
                <div class="name">
                    <h3>{{ $record ? $conversation->member_two->fullName : $conversation->member_one->fullName }}
                    </h3>
                </div>
            </div>
            <div class="right">
                <button class="message-minimize-button">
                    @include('frontEnd.svg.minimize')
                </button>
                <button class="message-close-button">
                    @include('frontEnd.svg.close')
                </button>
            </div>
        </div>
        <div class="message-popup-body">
            <ul id="messageBox">
                @include('frontEnd.layouts.ajax.messages')
            </ul>
        </div>
        <div class="message-popup-control">
            <div class="inner">
                <div class="input">
                    <input type="text" class="message-content" name="content">
                </div>
                <div class="submit">
                    @if ($conversation)
                        <button class="message-send" data-id="{{ $conversation->id }}">
                            @include('frontEnd.svg.send')
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @if (Session::has('conversation_id'))
        <script>
            let isLoading = false;
            $('.message-popup-body').on('scroll', function() {
                console.log('hello out');
                if ($(this).scrollTop() === 0 && !isLoading) {
                    console.log('hello');
                    let lastMessageId = $('.message-wrapper').first().data('id');
                    const conversation_id = globalConversationId || $('.message-send').attr('data-id');
                    console.log(lastMessageId);
                    $.ajax({
                        url: "{{ route('member.message.reload') }}",
                        type: 'GET',
                        data: {
                            id: conversation_id,
                            last_message_id: lastMessageId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'update') {
                                // Instead of replacing all messages, prepend older ones
                                $("#messageBox").prepend(response.updatedHtml);
                            }
                            isLoading = false;
                        },
                        error: function() {
                            isLoading = false; // reset loading even on error
                        }
                    });

                }
            });
            // message-popup-wrapper



            let globalConversationId = null; // 🔥 Store globally

            function updateMessages() {
                // const conversation_id = $('.message-send').data('id');
                const conversation_id = globalConversationId || $('.message-send').attr('data-id');
                if (conversation_id) {
                    console.log('Updating with ID:', conversation_id);
                    message_toggle(conversation_id);
                    // message_header(conversation_id);
                } else {
                    console.log('No conversation ID found');
                }
            }
        </script>
    @endif
    <script>
        $(document).ready(function() {
            setInterval(() => {
                updateMessages();
            }, 5000);
            $(document).on('click', '.member-conversation', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: '{{ route('member.conversation.create') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                    },
                    success: function(response) {
                        if (response.success) {
                            let conversationId = response.conversation.id;
                            $('.message-popup-wrapper').removeClass('d-none');
                            $('.message-send').attr('data-id', conversationId);
                            console.log('New conversation ID set:', conversationId);
                            globalConversationId = conversationId;
                            updateMessages();
                        } else {
                            alert(response.message || 'Failed to update cart');
                            if (response.status == 'unlogged') {
                                window.location.href = "{{ route('member.login') }}";
                            } else if (response.status == 'unpublished') {
                                window.location.href = "{{ route('member.member_publish') }}";
                            }
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating the cart.');
                    },
                });
            });


            // remove session
            $(document).on('click', '.message-close-button', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('member.remove.session') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".message-popup-inner").hide();
                        } else {
                            alert(response.message || 'Failed to update cart');
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating the cart.');
                    },
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // setInterval(() => {
            //     let id = {{ $conversation->id }};
            //     message_toggle(id);
            // }, 5000);
        });
        //     #messageBox
        let lastMessageId = 0; // Initialize
        function message_toggle(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('member.message.reload') }}",
                data: {
                    id: id,
                    last_id: lastMessageId
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === 'update') {
                        $("#messageBox").html(response.updatedHtml);
                        lastMessageId = response.last_id;
                    }
                },
            });
        }

        $(document).on('click', '.message-send', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const messageContent = $('.message-content').val();
            $.ajax({
                url: '{{ route('member.message.update') }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                    messageContent: messageContent,
                },
                success: function(response) {
                    if (response.success) {
                        let conversationId = response.conversation.id;
                        $('.message-content').val('');
                        return message_toggle(conversationId);
                    } else {
                        alert(response.message || 'Failed to update cart');
                    }
                },
                error: function() {
                    alert('An error occurred while updating the cart.');
                },
            });
        });
    </script>
@endsection
