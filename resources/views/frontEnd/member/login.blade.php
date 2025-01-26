@extends('frontEnd.layouts.master') 
@section('title','') 
@section('content')
@include('frontEnd.layouts.navigation')
<style>
.toggle-btn {
    position: absolute;
    top: 50%;
    right: 10px;
    cursor: pointer;
}
</style>
    
    {{-- <!-- bdmarrigesa98 --> --}}
    <div id="content" class="full-sections">
        <div class="container middle-content back-none pad-none" style="padding-top: 30px;">
            <div class="main-content" style="padding-bottom: 30px;">
                <div class="main-content-inner">
                    <div class="page-content">
                        <form action="{{ route('member_login') }}" method="POST">
                            @csrf
                            <div class="login-form back-leaf-white shadow">
                                <div class="login-padding-ma" style="padding-top: 15px;padding-bottom: 0;">
                                    <div style="text-align: center;">
                                        <h4 class="col-sm-12 control-label" style="text-align: center;margin-bottom: 10px;">মেম্বার লগইন</h4>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>মোবাইল নাম্বার</label>
                                                <input  name="phoneNumber" oninput="onlyNumbersAndConvert(this)" maxlength="11" placeholder="আপনার মোবাইল নাম্বার লিখুন" type="text" class="form-control  @error('phoneNumber') is-invalid @enderror" />
                                                @error('phoneNumber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label>পাসওয়ার্ড <span style="color: red;">*</span></label>
                                        <input type="password" placeholder="আপনার পাসওয়ার্ড লিখুন" value="{{old('password')}}" id="passwordInput" name="password" type="text" class="form-control @error('password') is-invalid @enderror" required />
                                        <span class="toggle-btn" id="togglePassword">&#128065;</span>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 control-label text-center">
                                                <a href="{{ route('member.forgotpass') }}" style="text-align:center; font-weight: 600;">পাসওয়ার্ড ভুলে গেছেন? ক্লিক করুন</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12" style="text-align: center;">
                                                <button style="width: 100%; margin-bottom: 10px;" id="loginBtn" type="submit" class="login-register-button">লগইন</button>
                                                <span class="logging" style="font-weight: 400; display: none;"><img src="/images/ajax-loader.gif" style="width: 22px;" />&nbsp;Please Wait. Its logging...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row" style="border-top: 1px solid #dcdcdc; margin-left: 0; margin-right: 0;">
                                    <div class="col-sm-12">
                                        <div style="padding: 25px; text-align: center;">
                                             <a href="{{ route('member.register') }}" class="register-button"> রেজিস্ট্রেশন করুন </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="how_register_sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="how_register">
                       <a href="https://youtube.com/shorts/BRskyC1MTLM" target="_blank"> 
                       <span>রেজিস্ট্রেশন পদ্ধতির ভিডিও</span>
                         <i class="fab fa-youtube" aria-hidden="true"></i>
                       </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @section('script')
<script>
    $(document).ready(function () {
    $('#togglePassword').click(function () {
      // Toggle the password field type
      var passwordField = $('#passwordInput');
      var fieldType = passwordField.attr('type');
      
      if (fieldType === 'password') {
        passwordField.attr('type', 'text');
        $('#togglePassword').html('&#128064;'); // Eye icon open
      } else {
        passwordField.attr('type', 'password');
        $('#togglePassword').html('&#128065;'); // Eye icon closed
      }
    });
  });
  
  
    function onlyNumbersAndConvert(input) {
        // Extract the value from the input
        let value = input.value;
        
        // Remove any non-numeric characters
         value = value.replace(/[^০-৯0-9]/g, '');
    
        // Optionally, convert the numbers to English numerals if needed
        value = convertToEnglishNumbersb(value);
    
        // Update the input value
        input.value = value;
    }
    // Example of a conversion function (if needed)
    function convertToEnglishNumbersb(value) {
        // Assuming the input might have Bengali or other numerals,
        // this function would convert them to English numerals
        const bengaliToEnglishMap = {
            '০': '0', '১': '1', '২': '2', '৩': '3', '৪': '4',
            '৫': '5', '৬': '6', '৭': '7', '৮': '8', '৯': '9'
        };
        return value.replace(/[০-৯]/g, function(match) {
            return bengaliToEnglishMap[match];
        });
    }
</script>
@endsection
    