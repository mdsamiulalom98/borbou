@extends('frontEnd.layouts.master') 
@section('title','') 
@section('content')

    @include('frontEnd.layouts.navigation')
    <div id="content" class="full-sections">
        <div class="container middle-content back-none pad-none" style="padding-top: 30px;">
            <div class="main-content" style="padding-bottom: 30px;">
                <div class="main-content-inner">
                    <div class="page-content">
                        <form action="{{ route('member.forgotsubmit') }}" method="POST" data-parsley-validate="">
                            @csrf
                            <div class="login-form back-leaf-white shadow">
                                <div class="login-padding-ma" style="padding: 33px; padding-top: 15px; padding-bottom: 5px; max-width: 400px; margin: 0px auto;">

                                    <div style="text-align: center;">
                                        <h4 class="col-sm-12 control-label" style="text-align: center; margin-bottom: 12px;">পাসওয়ার্ড ভুলে গেছেন</h4>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>মোবাইল নাম্বার</label>
                                                <input  name="phoneNumber" oninput="onlyNumbersAndConvert(this)"  maxlength="11" placeholder="আপনার মোবাইল নাম্বার লিখুন" type="text" required class="form-control  @error('phoneNumber') is-invalid @enderror" />
                                                @error('phoneNumber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12" style="text-align: center; margin-top: 5px;">
                                                <button style="width: 100%; margin-bottom: 10px;" id="loginBtn" type="submit" class="login-register-button">সেন্ড </button>
                                            </div>
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
    @endsection
    
@section('script')
<script src="{{asset('public/backEnd/')}}/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-validation.init.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-advanced.init.js"></script>
<script>
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