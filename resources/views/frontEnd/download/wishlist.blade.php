@extends('frontEnd.layouts.master') 
@section('title','')
@section('content')
@include('frontEnd.layouts.navigation')   

@php
    $subtotal = Cart::instance('wishlist')->subtotal();
    $subtotal = str_replace(',','',$subtotal);
    $subtotal = str_replace('.00', '',$subtotal);
@endphp
<div id="content" class="full-sections">
    <div class="container middle-content back-none pad-none" style="padding-top: 30px;">
        <div class="main-content" style="padding-bottom: 30px;">
            <div class="main-content-inner">
                <div class="page-content">
                    <div class="login-form back-leaf-white shadow">
                        <div class="login-padding-ma"
                            style="padding: 33px;padding-top: 15px;padding-bottom: 0;max-width: 400px;margin: 0px auto;">
                            <div style="text-align: center;">
                                <h4 class="col-sm-12 control-label" style="text-align: center;margin-bottom: 10px;">
                                    ডাউনলোড তালিকা </h4>
                            </div>
                            <div class="vcart-content" id="wishlist">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>মেম্বার </th>
                                                <th>মূল্য</th>
                                                <th>ডিলিট </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset($value->options->image) }}" alt="">
                                                        <span
                                                            style="margin: 15px auto 10px;display: block;font-weight: 600;">{{ $value->name }}</span>
                                                        <span
                                                            style="margin: 10px auto;display: block;font-weight: 600;">আইডি
                                                            নাম্বারঃ <span style="font-size: 17px;">
                                                                {{ App\Converter\enandbn\BanglaConverter::en2bn($value->options->member_id) }}
                                                            </span></span>
                                                    </td>
                                                    <td>{{ App\Converter\enandbn\BanglaConverter::en2bn($value->price) }}
                                                        টাকা</td>
                                                    <td>
                                                        <form action="{{ route('wishlist_remove') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="member_id"
                                                                value="{{ $value->rowId }}">
                                                            <button class="remove-cart delete_btn wishlist_remove"
                                                                data-id="{{ $value->rowId }}"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td colspan="2"><strong>সর্বমোট =
                                                        {{ App\Converter\enandbn\BanglaConverter::en2bn(number_format($subtotal, 0)) }}
                                                        টাকা</strong></td>
                                                <!--<td></td>-->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="process-to-payment">
                                <a href="{{ route('download.payment.confirm') }}" class="submit-secondary">পেমেন্ট করুন
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::guard('member')->user())
@if(Auth::guard('member')->user()->publish == 0)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#staticBackdrop').modal('show');
    });
</script>
@endif
@endif

@include('frontEnd.layouts.paymentmodal')
@endsection