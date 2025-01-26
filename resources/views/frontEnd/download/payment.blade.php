@extends('frontEnd.layouts.master') 
@section('title','') 
@section('content')
@include('frontEnd.layouts.navigation')
<section class="checkout-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="checkout-shipping">
                    <form action="{{route('download.payment.confirm')}}" method="POST" data-parsley-validate="">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>Payment Option</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Name <span>*</span></label>
                                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::guard('member')->user()->fullName ?? '' }}" placeholder="Type Your Name" required="">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">Mobile Number <span>*</span></label>
                                        <span data-feather="phone"></span>
                                        <input type="number" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{Auth::guard('member')->user()->phoneNumber}}"  required="">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                            </div>
                        </div>
                    </div>
                    <!-- card end -->
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="form-group shurjopay_agree">
                                <input type="checkbox" class="form-check-input"  required id="agree"> I agree to the <a href="https://shuvokaj.com/page/privacy-policy">Privacy Policy</a>, <a href="https://shuvokaj.com/page/terms-conditions">Terms and conditions</a> and <a href="https://shuvokaj.com/page/return-and-refund-policy">Return and Refund Policy.</a>
                            </div>
                            <button class="submit_btn" type="submit">Confirm Payment</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-4">
                 <div class="cart-summary">
                    @php
                        $subtotal = Cart::instance('wishlist')->subtotal();
                        $subtotal=str_replace(',','',$subtotal);
                        $subtotal=str_replace('.00', '',$subtotal);
                    @endphp
                    <h5>Summary</h5>
                    <table class="table">
                        <tbody>
                            <tr>

                                <td>Total CV</td>
                                <td>{{Cart::instance('wishlist')->count()}}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>৳ {{$subtotal}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- col end -->
        </div>
    </div>
</section>
@endsection
@section('script')

  <script>  
    $(document).ready(function(){
          $('.bkashform').show();
          $('.nagadform').hide();
          $('.trxform').show();
        $('.payment_method').on('click', function() {
          var id = $(this).data('id');
            if(id=="cod"){
              $('.bkashform').hide();
              $('.nagadform').hide();
              $('.trxform').show();
            }else if(id=='bkash'){
              $('.nagadform').hide();
              $('.bkashform').show();
              $('.trxform').show();
            }
            else if(id=='nagad'){
              $('.bkashform').hide();
              $('.nagadform').show();
              $('.trxform').show();
            }
            else if(id==''){
              $('.bkashform').hide();
              $('.nagadform').hide();
              $('.trxform').show();
            }
        });
         
    });
    </script>
    @section('script')
    <script src="{{asset('public/backEnd/')}}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/js/pages/form-advanced.init.js"></script>
    @endsection
@endsection