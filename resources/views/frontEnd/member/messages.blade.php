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
                                                @php

                                                @endphp
                                                <div class="col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                                    <div class="personal-box" style="margin-bottom: 12px;">
                                                        <div class="personali_item_title">
                                                            <div class="p_icon">
                                                                <i class="fa-solid fa-star"></i>
                                                            </div>
                                                            <div><span
                                                                    style="margin: 10px auto;display: block;font-weight: 600;text-align: center;padding-bottom: 5px;">রেজিস্ট্রেশন
                                                                    নাম্বারঃ <span
                                                                        style="font-size: 17px;">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->member_id) }}</span></span>
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
                                                                    <form action="{{ route('biodata.download.page') }}"
                                                                        method="post" style="display:block">
                                                                        @csrf
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $value->member_id }}">
                                                                        <button type="submit"
                                                                            style="outline: none; border: none;background: none;">
                                                                            <i class="fa fa-eye" style="color: #002a3a"></i>
                                                                            <span
                                                                                style="background-color: #002a3a;color: #f9f9f9;padding: 2px 10px;padding-top: 6px;border-radius: 15px;font-weight: 600;min-width: 80px;"
                                                                                class="d-block">বায়োডাটা </span>
                                                                        </button>
                                                                    </form>


                                                                    <button type="submit" data-id="{{ $value->member_one_id == $memberId ?  $value->member_two_id : $value->member_one_id }}"
                                                                        class="member-conversation"
                                                                        style="outline: none; border: none;background: none;">
                                                                        <i class="fa-brands fa-facebook-messenger"
                                                                            style="color: #ffcc00"></i>
                                                                        <span
                                                                            style="background-color: #ffcc00;color: #000000;padding: 2px 10px;padding-top: 6px;border-radius: 15px;font-weight: 600;min-width: 80px;"
                                                                            class="d-block">মেসেজ করুন {{ $value->member_one_id == $memberId ?  $value->member_two_id : $value->member_one_id }} == {{ $memberId }} </span>
                                                                    </button>

                                                                    <form
                                                                        action="{{ route('member.delete_pdf', ['id' => $value->id]) }}"
                                                                        method="post" style="display:block">
                                                                        @csrf
                                                                        <button
                                                                            style="outline: none; border: none;background: none;"
                                                                            class=""
                                                                            onclick="return confirm('আপনি কি ডিলিট করতে চাচ্ছেন?')">
                                                                            <i class="fa fa-trash" style="color: red;"></i>
                                                                            <span
                                                                                style="background-color: red;color: white;padding: 2px 10px;padding-top: 8px;border-radius: 15px;font-weight: 600;min-width: 80px;"
                                                                                class="d-block">ডিলিট </span>
                                                                        </button>
                                                                    </form>
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
