<div class="left">
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
