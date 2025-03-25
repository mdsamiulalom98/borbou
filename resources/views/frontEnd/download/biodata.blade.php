@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    <div id="changeit">
        @include('frontEnd.layouts.navigation')
    </div>

    <section class="profile" id="">
        <div class="container ">
            <div class="avatar-and-info">
                <div class="info-item">
                    <div class="info-item-header">
                        <h2><i class="fa-solid fa-user-pen"></i> বিস্তারিত বর্ণনা</h2>
                    </div>
                    <div class="info-item-details">
                        <div class="quality">
                            <div class="quality-list">
                                <div class="personal-list about-myself">
                                    {{ $aboutmyself->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-item-header">
                        <h2><i class="fa-solid fa-user"></i> {{ $member->fullName ?? '' }}</h2>
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
                    <div class="info-item-header details-gap">
                        <!-- If it is a female gender please use a female icon from here -->
                        <h2>
                            <i class="fa-solid fa-address-card"></i>
                            ব্যক্তিগত বিবরণ
                        </h2>
                    </div>
                    <div class="info-item-details">
                        <div class="quality">
                            <div class="personal-list">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                                <div>সম্পূর্ণ নাম</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $member->fullName ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                                <div>বাবার নাম</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $familylocation->father_name ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                                <div>মায়ের নাম</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $familylocation->mother_name ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-mobile-button"></i>
                                                </div>
                                                <div>মোবাইল নাম্বার </div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ App\Converter\enandbn\BanglaConverter::en2bn($member->phoneNumber) ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-mobile-button"></i>
                                                </div>
                                                <div>মোবাইল নাম্বার </div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $familylocation->alt_contact ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-heart"></i>
                                                </div>
                                                <div>বৈবাহিক অবস্থা </div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $basicInfo->maritalstatus ? $basicInfo->maritalstatus->title : '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-children"></i>
                                                </div>
                                                <div>বাচ্চার সংখ্যা </div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $basicInfo->children_no ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">

                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-regular fa-calendar-days"></i>
                                                </div>
                                                <div>বয়স</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ App\Converter\enandbn\BanglaConverter::en2bn($basicInfo->age) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-regular fa-calendar-days"></i>
                                                </div>
                                                <div>জন্ম তারিখ </div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ App\Converter\enandbn\BanglaConverter::en2bn(date('j F Y ', strtotime($basicInfo->dob))) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-mosque"></i>
                                                </div>
                                                <div>ধর্ম</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $basicInfo->religion ? $basicInfo->religion->title : '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-palette"></i>
                                                </div>
                                                <div>ত্বকের রং</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $basicInfo->pcomplexion->title ?: '' }}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-person-arrow-up-from-line"></i>
                                                </div>
                                                <div>উচ্চতা</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $basicInfo->feet }} ফুট {{ $basicInfo->inch }} ইঞ্চি
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">

                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-earth-americas"></i>
                                                </div>
                                                <div>জাতীয়তা</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $basicInfo->country ? $basicInfo->country->title : '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-earth-americas"></i>
                                                </div>
                                                <div>নাগরিকত্ব</div>
                                            </div>
                                            <div class="personal_item_content">
                                                {{ $basicInfo->nationality ? $basicInfo->nationality->title : '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="personal-box">
                                            <div class="personali_item_title">
                                                <div class="p_icon">
                                                    <i class="fa-solid fa-earth-americas"></i>
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
                    </div>


                    <div class="info-item">
                        <div class="info-item-header">
                            <h2><i class="fa-solid fa-user-graduate"></i> শিক্ষাগত যোগ্যতা</h2>
                        </div>

                        <div class="info-item-details">
                            @foreach ($educations as $key => $value)
                                <div class="quality">
                                    <div class="personal-list">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-graduation-cap"></i>
                                                        </div>
                                                        <div>শিক্ষাগত যোগ্যতা</div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $value->education ? $value->education->title : '' }}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-header">
                            <h2><i class="fa-solid fa-user-tie"></i> পেশাগত যোগ্যতা</h2>
                        </div>
                        <div class="info-item-details">
                            <div class="quality">
                                <div class="quality-list">
                                    <div class="personal-list">
                                        <div class="row">

                                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-user-tie"></i>
                                                        </div>
                                                        <div>পেশা</div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $career->profession ? $career->profession->title : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-user-tie"></i>
                                                        </div>
                                                        <div>কর্মক্ষেত্র</div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $career->working ? $career->working->title : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-item-header  details-gap">
                                <h2>
                                    <i class="fa-solid fa-house"></i>
                                    স্থায়ী ঠিকানা
                                </h2>
                            </div>
                            <div class="info-item-details">
                                <div class="quality">
                                    <div class="personal-list">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>গ্রাম / এরিয়া</div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->permanent_address ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>উপজেলা </div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->upazila ? $familylocation->upazila->title : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>জেলা </div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->district ? $familylocation->district->title : '' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>বিভাগ</div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->division->title ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-header  details-gap">

                                <h2>
                                    <i class="fa-solid fa-house"></i>
                                    বর্তমান ঠিকানা
                                </h2>
                            </div>
                            <div class="info-item-details">
                                <div class="quality">
                                    <div class="personal-list">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>গ্রাম / এরিয়া</div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->present_address ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>উপজেলা </div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->presentupazila ? $familylocation->presentupazila->title : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>জেলা </div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->presentdistrict ? $familylocation->presentdistrict->title : '' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                                                <div class="personal-box">
                                                    <div class="personali_item_title">
                                                        <div class="p_icon">
                                                            <i class="fa-solid fa-house"></i>
                                                        </div>
                                                        <div>বিভাগ</div>
                                                    </div>
                                                    <div class="personal_item_content">
                                                        {{ $familylocation->presentdivision->title ?? '' }}
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
            </div>
    </section>


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
                            }, 0);
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
