@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    @include('frontEnd.layouts.navigation')

    <div id="content" class="full-sections regiser-padding">
        <div class="container">
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="register-form verify-form shadow">

                            <div class="login-padding-ma"
                                style="padding: 33px;padding-top: 15px;padding-bottom: 0;max-width: 400px;margin: 0px auto;">
                                <div style="margin-top: 20px; text-align: center;">
                                    <h4 class="col-sm-12 control-label">একাউন্ট ভেরিফিকেশন </h4>
                                </div>

                                <form name="myForm" action="{{ route('verify_submit') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label style="padding-bottom: 5px;">ভেরিফিকেশন কোড নাম্বার </label>
                                                <input placeholder="ভেরিফিকেশন কোড নাম্বারটি লিখুন" type="number"
                                                    name="verifyPin" class="form-control" required="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12" style="text-align: center; margin-top: 5px;">
                                                <button style="width: 100%; margin-bottom: 10px;" type="submit"
                                                    class="login-register-button">সাবমিট </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('resendcode') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-info"><i class="fa-solid fa-rotate-right"></i> পুনরায় কোড
                                            পাঠান </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
