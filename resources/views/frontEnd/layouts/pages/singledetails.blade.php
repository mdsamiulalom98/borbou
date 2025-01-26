@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    <div id="changeit">
        @include('frontEnd.layouts.navigation')
    </div>
   
    <section class="profile" id="">
        <div class="container d-flex">
            <button class="cart_download mob_cart_download wishlistBtn" data-id="{{ $basicInfo->member_id }}"><i
                    class="fa-solid fa-star"></i> নির্বাচন করুন</button>

            <div class="avatar-and-info">
                @php
                    $cartItems = Cart::instance('wishlist')->content();
                    $inWishlist = null;

                    if ($cartItems->contains('id', $member->id)) {
                        $inWishlist = $cartItems->where('id', $member->id)->first();
                    }
                @endphp
                <div class="leftbox">
                    <div class="leftboxcotainer">
                        <button data-id="{{ $basicInfo->member_id }}" class="{{ $inWishlist ? 'red-color' : '' }} wishlistBtn">
                            <i class="fa-solid fa-star"></i>
                        </button>
                        <h2 class="name"> {{ $member->fullName ?? '' }}</h2>
                    </div>
                </div>
                <div class="profile-image">
                    @if ($image)
                        <div class="profile-image-item">
                            <img src="{{ asset($image->image_one) }}" alt="" />
                        </div>
                        <div class="profile-image-item">
                            <img src="{{ asset($image->image_two) }}" alt="" />
                        </div>
                        <div class="profile-image-item">
                            <img src="{{ asset($image->image_three) }}" alt="" />
                        </div>
                    @endif
                </div>
            </div>

            <div class="profile-info">
                <div class="info-item">
                    <div class="info-item-header">
                        <h2><i class="icofont-education"></i> শিক্ষাগত ও পেশাগত যোগ্যতা</h2>
                    </div>
                    <div class="info-item-details">
                        <div class="quality">
                            <div class="quality-list">
                                <div class="personal-list">
                                    @foreach ($educations as $key => $value)
                                    <div class="personal-box">
                                        <div class="personali_item_title">
                                            <div class="p_icon">
                                                <img src="{{ asset('public/frontEnd/images/icons/') }}/education.png"
                                                    alt="" />
                                            </div>
                                            <div>শিক্ষা</div>
                                        </div>
                                        <div class="personal_item_content">
                                            {{ $value->education ? $value->education->title : '' }}
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="personal-box">
                                        <div class="personali_item_title">
                                            <div class="p_icon">
                                                <img src="{{ asset('public/frontEnd/images/icons/') }}/profession.png"
                                                    alt="" />
                                            </div>
                                            <div>পেশা</div>
                                        </div>
                                        <div class="personal_item_content">
                                            {{ $career->profession ? $career->profession->title : '' }}
                                        </div>
                                    </div>
                                    
                                    
                                    <!--<div class="personal-box">-->
                                    <!--    <div class="personali_item_title">-->
                                    <!--        <div class="p_icon">-->
                                    <!--            <img src="{{ asset('public/frontEnd/images/icons/') }}/working.png"-->
                                    <!--                alt="" />-->
                                    <!--        </div>-->
                                    <!--        <div>কর্মক্ষেত্র</div>-->
                                    <!--    </div>-->
                                    <!--    <div class="personal_item_content">-->
                                    <!--        {{ $career->working ? $career->working->title : '' }}-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--
                <div class="info-item">
                    <!--<div class="info-item-header">-->
                    <!--    <h2><i class="icofont-education"></i> শিক্ষাগত যোগ্যতা</h2>-->
                    <!--</div>-->
                    
                    <div class="info-item-details">
                        @foreach ($educations as $key => $value)
                            <div class="quality">
                                <div class="personal-list">
                                    <div class="personal-box">
                                        <div class="personali_item_title">
                                            <div class="p_icon">
                                                <img src="{{ asset('public/frontEnd/images/icons/') }}/education.png"
                                                    alt="" />
                                            </div>
                                            <div>শিক্ষাগত যোগ্যতা</div>
                                        </div>
                                        <div class="personal_item_content">
                                            {{ $value->education ? $value->education->title : '' }}
                                        </div>
                                    </div>
                                    <!--<div class="personal-box">-->
                                    <!--    <div class="personali_item_title">-->
                                    <!--        <div class="p_icon">-->
                                    <!--            <img src="{{ asset('public/frontEnd/images/icons/') }}/degree.png"-->
                                    <!--                alt="" />-->
                                    <!--        </div>-->
                                    <!--        <div>ডিগ্রীর নাম</div>-->
                                    <!--    </div>-->
                                    <!--    <div class="personal_item_content">-->
                                    <!--        {{ $value->degree ? $value->degree->title : '' }}-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="personal-box">-->
                                    <!--    <div class="personali_item_title">-->
                                    <!--        <div class="p_icon">-->
                                    <!--            <img src="{{ asset('public/frontEnd/images/icons/') }}/year.png" alt="" />-->
                                    <!--        </div>-->
                                    <!--        <div>পাশের সাল </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="personal_item_content">-->
                                    <!--        {{ $value->alt_degree }}-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                --}}
                <div class="info-item">
                    <div class="info-item-header details-gap">
                        <!-- If it is a female gender please use a female icon from here -->
                        <h2>
                            <i class="icofont-man-in-glasses"></i>
                            <!-- <i class="icofont-woman-in-glasses"></i>-->
                            ব্যক্তিগত বিবরণ
                        </h2>
                    </div>
                    <div class="info-item-details">
                        <div class="quality">
                            <div class="personal-list">

                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/marital_status.svg"
                                                alt="" />
                                        </div>
                                        <div>বৈবাহিক অবস্থা</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->maritalstatus ? $basicInfo->maritalstatus->title : '' }}
                                    </div>
                                </div>

                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/children.png"
                                                alt="" />
                                        </div>
                                        <div>বাচ্চা</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->children_no }}
                                    </div>
                                </div>


                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/age-group.png"
                                                alt="" />
                                        </div>
                                        <div>বয়স</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($basicInfo->age) }}
                                    </div>
                                </div>
                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/religion_islam.svg"
                                                alt="" />
                                        </div>
                                        <div>ধর্ম</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->religion ? $basicInfo->religion->title : '' }}
                                    </div>
                                </div>

                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/home-icon.png"
                                                alt="" />
                                        </div>
                                        <div>জেলা </div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $familylocation->district ? $familylocation->district->title : '' }}
                                    </div>
                                </div>

                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/nationality.svg"
                                                alt="" />
                                        </div>
                                        <div>জাতীয়তা</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->country ? $basicInfo->country->title : '' }}
                                    </div>
                                </div>
                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/nationality.svg"
                                                alt="" />
                                        </div>
                                        <div>নাগরিকত্ব</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->nationality ? $basicInfo->nationality->title : '' }}
                                    </div>
                                </div>
                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/nationality.svg"
                                                alt="" />
                                        </div>
                                        <div>আবাসস্থল</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->recidency ? $basicInfo->recidency->title : '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--
                <div class="info-item">
                    <div class="info-item-header  details-gap">

                        <h2>
                            <i class="icofont-muscle"></i>
                            শারীরিক বিবরণ
                        </h2>
                    </div>
                    <div class="info-item-details">
                        <div class="quality">
                            <div class="personal-list">
                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/skincolor.png"
                                                alt="" />
                                        </div>
                                        <div>ত্বকের রং</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->pcomplexion->title ?: '' }}
                                    </div>
                                </div>
                                <div class="personal-box">
                                    <div class="personali_item_title">
                                        <div class="p_icon">
                                            <img src="{{ asset('public/frontEnd/images/icons/') }}/height.svg"
                                                alt="" />
                                        </div>
                                        <div>উচ্চতা</div>
                                    </div>
                                    <div class="personal_item_content">
                                        {{ $basicInfo->feet }} ফুট {{ $basicInfo->inch }} ইঞ্চি
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                --}}
            </div>
        </div>
    </section>

    <div class="download-section">
        <div class="download-button">
            {{--
            <button type="button" class="wishlistBtn"
                data-bs-toggle="{{ Auth::guard('member')->user() && Auth::guard('member')->user()->publish == 0 ? 'modal' : '' }}"
                data-bs-target="{{ Auth::guard('member')->user() && Auth::guard('member')->user()->publish == 0 ? '#staticBackdrop' : '' }}"
                data-download="{{ Auth::guard('member')->user() && Auth::guard('member')->user()->publish == 1 ? 'true' : 'false' }}"
                data-id="{{ $basicInfo->member_id }}">
                যোগাযোগ করুন
            </button>
            --}}
            <a href="{{ route('wishlist') }}?id={{ $member->id }}" class="">
                যোগাযোগ করুন
            </a>
            {{-- @if (Auth::guard('member')->user())
                @if (Auth::guard('member')->user()->publish == 0)
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        যোগাযোগ করুন
                    </button>
                @else
                    <input type="hidden" value="download" name="download">
                    <button type="submit">
                        যোগাযোগ করুন
                    </button>
                @endif
            @else
                <button type="submit">
                    যোগাযোগ করুন
                </button>

            @endif --}}
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function navigationReload() {
            $.ajax({
                type: "GET",
                url: "{{ route('navigation.change') }}",
                dataType: "html",
                success: function(response) {
                    $('#changeit').html(response);
                },
            });
        }
        function wishlistReload() {
            $.ajax({
                type: "GET",
                url: "{{ route('wishlist.count') }}",
                dataType: "html",
                success: function(response) { 
                    $('#wishCount').html(response);
                },
            });
        }
        $(document).ready(function() {
            $('.wishlistBtn').click(function(e) {
                e.preventDefault();
                let button = $(this);
                let token = $('meta[name="csrf-token"]').attr('content');
                let download = button.data('download');
                let member_id = $(this).data('id');
                let data = {
                    _token: token,
                    member_id: member_id,
                    download: download
                };
                // Add download to data if it's true
                $.ajax({
                    url: '{{ route('add_to_wishlist') }}',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            navigationReload();
                            wishlistReload();
                            $('.wishlistBtn').addClass('red-color');
                        } else if (response.status === 'error') {
                            toastr.error(response.message);
                        } else if (response.status === 'redirect') {
                            toastr.info(response.message);
                            setTimeout(function() {
                                window.location.href = response.redirect_url;
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
    @if (Auth::guard('member')->user())
        @if (Auth::guard('member')->user()->publish == 0)
            <script>
                $(document).ready(function() {
                    $('#staticBackdrop').modal('show');
                });
            </script>
        @endif
    @endif
    @include('frontEnd.layouts.paymentmodal')
@endsection
