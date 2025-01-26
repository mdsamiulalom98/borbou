@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    @include('frontEnd.layouts.navigation')
    @include('frontEnd.layouts.pagenavigation')
    <section class="contact-section">
        <div class="container">
            <div class="align-items-center justify-content-center row" style="height: 260px;">
                <div class="col-sm-10">
                    <div class="contact_info d-none">
                        <div class="conttact_phone d-none">
                            <i class="fa fa-phone"></i> {{ $contact->phone }}
                        </div>
                        {{--
                        <div class="conttact_email">
                            <i class="fa fa-envelope"></i> {{ $contact->email }}
                        </div>
                        --}}
                    </div>
                    <div class="contact-item-box justify-content-center">
                        
                    </div>
                    <div class="contact-item-box">
                        <div class="contact-item ">
                            <a href="tel:{{ $contact->phone }}">
                                <img src="{{ asset('public/frontEnd/images/phone-icon-12-12-24.png') }}" />
                                <h5>{{ $contact->phone }}</h5>
                            </a>
                        </div>
                        @foreach($socialmedia as $key => $value)
                        <div class="contact-item">
                            <a href="{{ $value->link }}">
                                <img src="{{ asset($value->image) }}" />
                                <h5>{{ $value->title }}</h5>
                            </a>
                        </div>
                        @endforeach
                        
                    <!--</div>-->
                    <!--<div class="contact-item-box mt-4">-->
                        
                        
                    </div>
                    
                    <div class="contact-item-box app-item-box d-flex justify-content-center">
                        <div class="contact-item app-item">
                            <a href="{{ asset('public/frontEnd/apk/borbou-1.0.0.apk') }}">
                                <img src="{{ asset('public/frontEnd/images/google-play-12-12-24.png') }}" />
                                <!--<h5>Play Store</h5>-->
                            </a>
                        </div>
                    </div>
                    
                    <div class="contact-form d-none">
                        <div class="text-center">
                            <h5 class="account-title">অথবা </h5>
                        </div>
                        <form action="{{ route('contactinfosave') }}" method="POST" class="row"
                            data-parsley-validate="">
                            @csrf
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="name">নাম *</label>
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required>
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
                                    <label for="phone">মোবাইল নাম্বার *</label>
                                    <input type="text" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="subject">বিষয় *</label>
                                    <input type="text" id="subject"
                                        class="form-control @error('subject') is-invalid @enderror" name="subject"
                                        value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="cont_message">বর্ণনা *</label>
                                    <textarea rows="5" maxlength="500" id="cont_message"
                                        class="form-control @error('cont_message') is-invalid @enderror" name="cont_message"
                                        value="{{ old('cont_message') }}" required></textarea>
                                    @error('cont_message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $cont_message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12 text-center">
                                <div class="form-group mb-3">
                                    <button type="submit" class="submit-btn">সেন্ড </button>
                                </div>
                            </div>
                            <!-- col-end -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
