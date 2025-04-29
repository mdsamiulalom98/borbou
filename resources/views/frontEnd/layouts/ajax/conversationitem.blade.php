@if ($conversations->isEmpty())
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>কোনো বার্তা নেই</p>
        </div>
    </div>
@else
    <div class="message-page-list">
        @foreach ($conversations as $key => $value)
            @php
                $otherMember = $value->member_one_id == $loggedInMemberId ? $value->member_two : $value->member_one;
                $otherMemberImage = $otherMember->memberimage->image_one ?? 'default.png';
                $otherMemberName = $otherMember->basicinfo->fullName ?? '';
            @endphp

            <a href="{{ route('member.conversation', $value->id) }}">
                <div class="message-item {{ $value->unreadMessagesCount > 0 ? 'unread' : '' }}">
                    <div class="message-item-wrapper" data-id="{{ $value->id }}">
                        <div class="image">
                            <img src="{{ asset($otherMemberImage) }}" alt="{{ $otherMemberName }}">
                        </div>
                        <div class="content">
                            <h3>{{ $otherMemberName }}</h3>
                            <p class="{{ $value->lastMessage?->is_read == 0 ? 'unseen' : '' }}">
                                {{ $value->lastMessage->content ?? '' }}
                            </p>
                        </div>
                    </div>

                    @php
                        $date = optional($value->lastMessage)->created_at
                            ? Carbon\Carbon::parse($value->lastMessage->created_at)
                            : null;
                    @endphp

                    <div class="message-action">
                        <p>
                            @if ($value->messages->count() > 0 && $date)
                                <span class="badge badge-danger">{{ $value->unreadMessagesCount }}</span>
                                @php
                                    $now = now();
                                    $diffInSeconds = $date->diffInSeconds($now);
                                    $diffInMinutes = $date->diffInMinutes($now);
                                    $diffInHours = $date->diffInHours($now);
                                    $diffInDays = $date->diffInDays($now);
                                    $isToday = $date->isToday();
                                @endphp

                                @if ($diffInSeconds < 60)
                                    Just now
                                @elseif ($diffInMinutes < 60)
                                    {{ $diffInMinutes }}m ago
                                @elseif ($isToday)
                                    {{ $date->format('h:i A') }}
                                @elseif ($diffInDays === 1)
                                    Yesterday
                                @elseif ($diffInDays < 7)
                                    {{ $date->format('M j') }}
                                @elseif ($diffInDays < 365)
                                    {{ $date->format('M j') }}
                                @else
                                    {{ $date->format('M j, Y') }}
                                @endif
                            @endif
                        </p>
                    </div>
                </div>
            </a>
        @endforeach

        {{-- @foreach ($datas as $key => $value)
            <div>
                @php
                    $memberId = \App\Models\Member::where('id', $value->member_id)->first()->id;
                    $memberImage = \App\Models\Memberimage::where('member_id', $memberId)->first()->image_one;
                @endphp
                <div class="message-item ">
                    <div class="message-wrapper" data-id="{{ $value->id }}">
                        <div class="image">
                            <img src="{{ asset($memberImage) }}">
                        </div>
                        <div class="content">
                            <h3>{{ $value->name }}
                            </h3>
                            <p>kono message nai</p>
                        </div>
                    </div>
                    <div class="message-action">
                        <form action="{{ route('create.coversation') }}" method="POST">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $value->member_id }}">
                            <button class="message-action-button btn btn-primary" type="submit">
                                <i class="fa fa-message"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
@endif
