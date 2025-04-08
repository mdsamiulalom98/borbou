@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
<div class="message-popup-inner">
    <div class="message-popup-header">
        <div class="left">
            <div class="back">
                <button class="message-back-button">
                    <i class="fa fa-arrow-left"></i>
                </button>
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
        <ul id="messageBox"></ul>
    </div>
    <div class="message-popup-control">
        <div class="inner">
            <div class="input">
                <input type="text" class="message-content" name="content">
            </div>
            <div class="submit">
                @if ($conversation)
                    <button class="message-send" >
                        @include('frontEnd.svg.send')
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@stack('script')
@
