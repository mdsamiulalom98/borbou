@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    @include('frontEnd.layouts.navigation')
    <div id="content" class="full-sections">
        <div class="container middle-content back-none pad-none" style="padding-top: 30px;">
            <div class="main-content" style="padding-bottom: 30px;">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="login-form back-leaf-white shadow">
                            <div class="login-padding-ma"
                                style="padding: 33px;padding-top: 15px;padding-bottom: 5px;max-width: 400px;margin: 0px auto;">
                                <div style="text-align: center;">
                                    <h5 class="account-title mb-1">জীবন বৃত্তান্ত তালিকা </h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>

                                                <th>মেম্বার </th>
                                                <th>ডাউনলোড</th>
                                                <th>ডিলিট </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $key => $value)
                                                <tr>
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
                                                    <td>
                                                        <img style="width: 50px;text-align: center;border-radius: 50px;background: #fff;padding: 1px;height: 50px;display: block;margin: 0 auto;"
                                                            src="{{ asset($memberImage) }}">
                                                        <span
                                                            style="margin: 15px auto 10px;display: block;font-weight: 600;text-align: center;">{{ $value->name }}</span>
                                                        <span
                                                            style="margin: 10px auto;display: block;font-weight: 600;text-align: center;">আইডি
                                                            নাম্বারঃ <span
                                                                style="font-size: 17px;">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->member_id) }}</span></span>
                                                    </td>

                                                    <td class="text-center"><a href="{{ route('member.download_pdf', ['member_id' => $value->member_id]) }}"
                                                            class="invoice_btn"><i class="fa fa-download"></i></a></td>
                                                    <td class="text-center">
                                                        <form
                                                            action="{{ route('member.delete_pdf', ['id' => $value->id]) }}"
                                                            method="post" style="display:inline-block"> @csrf <button
                                                                class="delete_btn"
                                                                onclick="return confirm('আপনি কি ডিলিট করতে চান?')"><i
                                                                    class="fa fa-trash"></i></button></form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
