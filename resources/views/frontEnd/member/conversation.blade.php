@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
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
    <script>
        $(document).ready(function () {
            setInterval(() => {
                let id = {{ $conversation->id }};
                message_toggle(id);
            }, 5000);
        });
        //     #messageBox
        function message_toggle(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('member.message.reload') }}",
                data: {
                    id: id,
                },
                dataType: "html",
                success: function (data) {
                    // $(".message-popup-wrapper").show();
                    $("#messageBox").html(data);
                },
            });
        }

        $(document).on('click', '.message-send', function (e) {
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
                success: function (response) {
                    if (response.success) {
                        let conversationId = response.conversation.id;
                        $('.message-content').val('');
                        return message_toggle(conversationId);
                    } else {
                        alert(response.message || 'Failed to update cart');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the cart.');
                },
            });
        });
    </script>
@endsection
