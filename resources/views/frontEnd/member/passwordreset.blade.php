@extends('frontEnd.layouts.master') 
@section('title','') 
@section('content')
<style>
.toggle-btn {
    position: absolute;
    top: 50%;
    right: 10px;
    cursor: pointer;
}
</style>
    @include('frontEnd.layouts.navigation')
    <div id="content" class="full-sections">
        <div class="container middle-content back-none pad-none" style="padding-top: 30px;">
            <div class="main-content" style="padding-bottom: 30px;">
                <div class="main-content-inner">
                    <div class="page-content">
                        <form action="{{ route('member.passresetverify') }}" method="POST" data-parsley-validate="">
                            @csrf
                            <div class="login-form back-leaf-white shadow">
                                
                                        <div class="login-padding-ma" style="padding: 30px; padding-top: 10px; padding-bottom: 0; max-width: 400px; margin: 0px auto;">
    
                                            <div style="text-align: center;">
                                                <h4 class="col-sm-12 control-label" style="text-align: center; padding: 10px; padding-bottom: 5px;">নতুন পাসওয়ার্ড</h4>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>ভেরিফিকেশন কোড নাম্বার</label>
                                                        <input  name="passResetToken" placeholder="ভেরিফিকেশন কোড নাম্বারটি লিখুন" type="text" required class="form-control  @error('passResetToken') is-invalid @enderror" />
                                                        @error('passResetToken')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    
                                            </div>
                                            </div>
                                            <div class="form-group position-relative">
                                                <label>নতুন পাসওয়ার্ড লিখুন <span style="color: red;">*</span></label>
                                                <input type="password" value="{{old('password')}}" id="passwordInput" placeholder="আপনার নতুন পাসওয়ার্ড লিখুন" name="password" type="text" class="form-control @error('password') is-invalid @enderror" required />
                                                <span class="toggle-btn" id="togglePassword">&#128065;</span>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                                
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12" style="text-align: center; margin-top: 5px;">
                                                        <button style="width: 100%; margin-bottom: 10px;" id="loginBtn" type="submit" class="login-register-button">সাবমিট </button>
                                                    </div>
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
</script>
@endsection