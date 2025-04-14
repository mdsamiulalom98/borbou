@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    @include('frontEnd.layouts.navigation')
    @php
        $memberId = Auth::guard('member')->user()->id;
    @endphp
    <div class="message-page-wrapper">
        <div class="message-page-header">
            <h3>মেসেজ</h3>
        </div>
        <div class="message-page-body">
            @if ($conversations->isEmpty())
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p>কোনো বার্তা নেই</p>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach ($conversations as $key => $value)
                        <a href="{{ route('member.conversation', $value->id) }}">
                            <div class="message-item {{ $value->unreadMessagesCount > 0 ? 'unread' : '' }}">
                                <div class="message-item-wrapper" data-id="{{ $value->id }}">
                                    <div class="image">
                                        <img
                                            src="{{ asset($value->member_one_id == $memberId ? $value->member_two->memberimage->image_one : $value->member_one->memberimage->image_one) }}">
                                    </div>
                                    <div class="content">
                                        <h3>{{ $value->member_one->id == $memberId ? $value->member_two->fullName : $value->member_one->fullName }}
                                        </h3>
                                        <p class="{{ $value->lastMessage?->is_read == 0 ? 'unseen' : '' }}">
                                            {{ $value->lastMessage ? $value->lastMessage->content : '' }}</p>
                                    </div>
                                </div>
                                @php
                                    $date = Carbon\Carbon::parse($value->lastMessage?->created_at);
                                @endphp
                                <div class="message-action">
                                    <p>
                                        @if ($value->messages->count() > 0)
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
                                                {{-- Show exact time if today (after 1 hour) --}}
                                                {{ $date->format('h:i A') }} {{-- e.g., "04:12 PM" --}}
                                            @elseif ($diffInDays === 1)
                                                Yesterday
                                            @elseif ($diffInDays < 7)
                                                {{ $date->format('M j') }} {{-- e.g., "Mar 15" (instead of "2d ago") --}}
                                            @elseif ($diffInDays < 365)
                                                {{ $date->format('M j') }} {{-- e.g., "Mar 15" --}}
                                            @else
                                                {{ $date->format('M j, Y') }} {{-- e.g., "Mar 15, 2023" --}}
                                            @endif
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @foreach ($datas as $key => $value)
                        <div>
                            @php
                                $memberId = \App\Models\Member::where('id', $value->member_id)->first()->id;
                                $memberImage = \App\Models\Memberimage::where('member_id', $memberId)->first()
                                    ->image_one;
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
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endsection
