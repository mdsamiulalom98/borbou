@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    @include('frontEnd.layouts.navigation')
    @php
        $memberId = Auth::guard('member')->user()->id;
    @endphp
    <div id="content" class="full-sections">
        <div class="container middle-content back-none pad-none" style="padding-top: 30px;">
            <div class="main-content" style="padding-bottom: 30px;">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="login-form back-leaf-white shadow">
                            <div class="login-padding-ma"
                                style="padding: 0px;padding-top: 15px;padding-bottom: 5px;max-width: 400px;margin: 0px auto;">
                                <div style="text-align: center;">
                                    <h5 class="account-title mb-1">বায়োডাটা তালিকা </h5>
                                </div>
                                <div class="table-responsive">
                                    <div class="">

                                        <div class="py-2">
                                            @foreach ($conversations as $key => $value)
                                                <div class="col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                                    <div class="personal-box" style="margin-bottom: 12px;">
                                                        <div class="personali_item_title">
                                                            <div class="p_icon">
                                                                <i class="fa-solid fa-star"></i>
                                                            </div>

                                                        </div>
                                                        <div class="personal_item_content">
                                                            <div>
                                                                <div class="d-flex justify-content-between">
                                                                    <img style="width: 60px;text-align: center;border-radius: 5px;background: #fff;padding: 1px;height: 60px;display: inline-block;border: 4px solid;border-color: #ffcc00;"
                                                                        src="">
                                                                    <span
                                                                        style="margin: 15px auto 10px;display: block;font-weight: 600;text-align: center;">{{ $value->name }}</span>
                                                                </div>

                                                                <div class="d-flex justify-content-evenly mt-3">
                                                                    <button type="submit" data-id="{{ $value->member_one_id == $memberId ? $value->member_two_id : $value->member_one_id }}"
                                                                        class="member-conversation"
                                                                        style="outline: none; border: none;background: none;">
                                                                        <i class="fa-brands fa-facebook-messenger"
                                                                            style="color: #ffcc00"></i>
                                                                        <span
                                                                            style="background-color: #ffcc00;color: #000000;padding: 2px 10px;padding-top: 6px;border-radius: 15px;font-weight: 600;min-width: 80px;"
                                                                            class="d-block">মেসেজ করুন {{ $value->member_one_id == $memberId ?  $value->member_two_id : $value->member_one_id }} == {{ $memberId }} </span>
                                                                    </button>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
