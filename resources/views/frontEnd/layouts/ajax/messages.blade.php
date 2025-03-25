@php
    $conversation_id = Session::get('conversation_id');
    $loggedInMemberId = Auth::guard('member')->user()->id;

    // Ensure conversation ID exists before querying
    $conversation = $conversation_id
        ? \App\Models\Conversation::with('member_one', 'member_two')->find($conversation_id)
        : null;

    // Ensure conversation exists before proceeding
    if ($conversation) {
        $record = \App\Models\Conversation::where('member_one_id', $loggedInMemberId)->first();

        // Check if member_two or member_one exists before accessing properties
        if ($record) {
            $conversationMemberImage = optional($conversation->member_two)->memberimage->image_one;
        } else {
            $conversationMemberImage = optional($conversation->member_one)->memberimage->image_one;
        }
    } else {
        $conversationMemberImage = null; // Default value if conversation is missing
    }

    $messages = Session::get('messages');
@endphp

@if ($conversation)
    @foreach ($messages as $key => $value)
        <li data-value="{{ $conversation_id }}"
            class="message-wrapper {{ $value->sender_id == $loggedInMemberId ? 'member' : '' }} {{ $value->status == 0 ? 'inactive' : '' }}"
            data-id="{{ $value->id }}">
            @if ($value->sender_id != $loggedInMemberId)
                <div class="avatar">
                    <img src="{{ asset($conversationMemberImage ?? '') }}">
                </div>
            @endif
            <div class="content">
                <p>{{ $value->content }}</p>
            </div>
        </li>
    @endforeach
@endif
