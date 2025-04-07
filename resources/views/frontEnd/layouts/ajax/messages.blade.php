@php
    $conversation_id = Session::get('conversation_id');
    $loggedInMemberId = Auth::guard('member')->user()->id;

    // Ensure conversation ID exists before querying
    $conversation = $conversation_id
        ? \App\Models\Conversation::with('member_one', 'member_two')->find($conversation_id)
        : null;

    $messages = Session::get('messages');
@endphp

@if ($conversation)
    @foreach ($messages as $value)
        <li data-value="{{ $conversation_id }}"
            class="message-wrapper {{ $value->sender_id == $loggedInMemberId ? 'member' : '' }} {{ $value->status == 0 ? 'inactive' : '' }}"
            data-id="{{ $value->id }}">
            <div class="content">
                <p>{{ $value->content }}</p>
            </div>
        </li>
    @endforeach
@endif
