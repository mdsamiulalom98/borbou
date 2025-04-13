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
                                    <div class="message-wrapper" data-id="{{ $value->id }}">
                                        <div class="image">
                                            <img
                                                src="{{ asset($value->member_one_id == $memberId ? $value->member_two->memberimage->image_one : $value->member_one->memberimage->image_one) }}">
                                        </div>
                                        <div class="content">
                                            <h3>{{ $value->member_one->id == $memberId ? $value->member_two->fullName : $value->member_one->fullName }}
                                            </h3>
                                            <p class="{{ $value->lastMessage?->is_read == 0 ? 'unseen' : '' }}">{{ $value->lastMessage ? $value->lastMessage->content : '' }}</p>
                                        </div>
                                    </div>
                                    @php
                                        $date = Carbon\Carbon::parse($value->lastMessage?->created_at);
                                    @endphp
                                    <div class="message-action">
                                        <p>
                                            @if ($value->messages->count() > 0)
                                                <span class="badge badge-danger">{{ $value->unreadMessagesCount }}</span>
                                                @if ($date->diffInSeconds(now()) < 60)
                                                    {{ $date->diffInSeconds(now()) }} seconds ago
                                                @elseif($date->diffInHours(now()) < 1)
                                                    {{ $date->diffInMinutes(now()) }} minutes ago
                                                @elseif($date->diffInDays(now()) < 1)
                                                    {{ $date->diffInHours(now()) }} hours ago
                                                @elseif($date->diffInDays(now()) < 7)
                                                    {{ $date->diffInDays(now()) }} days ago
                                                @elseif($date->diffInWeeks(now()) < 4)
                                                    {{ $date->diffInWeeks(now()) }} weeks ago
                                                @elseif($date->diffInMonths(now()) < 12)
                                                    {{ $date->diffInMonths(now()) }} months ago
                                                @elseif($date->diffInYears(now()) < 1)
                                                    {{ $date->diffInYears(now()) }} years ago
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
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endsection
