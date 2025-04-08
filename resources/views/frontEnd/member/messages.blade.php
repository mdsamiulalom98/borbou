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
                            <div class="message-item col-sm-12 ">
                                <div class="message-wrapper" data-id="{{ $value->id }}">
                                    <div class="image">
                                        <img
                                            src="{{ asset($value->member_one->id == $memberId ? $value->member_two->image : $value->member_one->image) }}">
                                    </div>
                                    <div class="content">
                                        <h3>{{ $value->member_one->id == $memberId ? $value->member_two->fullName : $value->member_one->fullName }}
                                        </h3>
                                        <p>{{ $value->lastMessage ? $value->lastMessage->content : '' }}</p>
                                    </div>
                                </div>
                                @php
                                    $date = Carbon\Carbon::parse($value->lastMessage->created_at);
                                @endphp
                                <div class="message-action">
                                    <p>
                                        @if ($date->isToday())
                                            {{ $date->diffForHumans() }}
                                        @elseif ($date->isYesterday())
                                            Yesterday
                                        @elseif ($date->isCurrentYear())
                                            {{ $date->format('g:i A') }}
                                        @else
                                            {{ $date->format('n/j/y') }}
                                        @endif
                                    </p>
                                </div>

                            </div>

                    @endforeach
                    @foreach ($datas as $key => $value)
                            @php
                                $memberId = \App\Models\Member::where(
                                    'id',
                                    $value->member_id,
                                )->first()->id;
                                $memberImage = \App\Models\Memberimage::where(
                                    'member_id',
                                    $memberId,
                                )->first()->image_one;
                            @endphp
                            <div class="message-item col-sm-12 ">
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
                                    <button class="message-action-button" data-id="{{ $value->id }}">
                                        <i class="fa fa-message"></i>
                                    </button>
                                </div>
                            </div>

                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endsection
