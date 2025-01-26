@extends('frontEnd.layouts.master')
@section('title', '')

@section('fbsharetitle', '')
@section('fbshareurl', url()->current())
@section('fbshareimage', asset('public/frontEnd/images/logo.png'))
@section('content')
    @include('frontEnd.layouts.navigation')
    
    <span id="device-width" style="
    position: fixed;
    top: 160px;
    z-index: 999;
    color: transparent;
"></span>
    <div class="hero">
        <div class="warraper">
            <div class="container d-flex">
                <!-- ROW -->
                <div class="row">
                    <div class="hero-content">
                        <img src="{{ asset('public/frontEnd/images/Bor Bou.png') }}" alt="">
                        
                        <div class="card-body" style="position: absolute;color: transparent;z-index: -1">
                            <p> Bor Bou - The Best Matrimony Website in Bangladesh | Register Now! Join the Top Online Marriage Media and Find Your Perfect Life Partner. </p>
                        </div>


                        <div class="hero-form">
                            
                        <div class="about-sort-intro" style="position: absolute; z-index: -1">
                            <p style="color: transparent;"> Bor Bou - The Best Matrimony Website in Bangladesh | Register Now! Join the Top Online Marriage Media and Find Your Perfect Life Partner. </p>
                        </div>
                            
                            <form action="{{ route('home') }}" method="GET">
                                <div class="search-form-row">
                                    <div class="homeinput">
                                        <div class="gender home-input-item">
                                            <div class="box">
                                                <label>বর বউ</label>
                                                <select class="hero-filter-dp form-select no-select2" name="gender">
                                                    <option value="" selected="">নির্বাচন করুন </option>
                                                    <option {{ request()->get('gender') == 1 ? 'selected' : '' }} value="1">
                                                        বর</option>
                                                    <option {{ request()->get('gender') == 2 ? 'selected' : '' }} value="2">
                                                        বউ</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="marital-status home-input-item">
                                            <div class="box">
                                                <label>বৈবাহিক অবস্থা</label>
                                                <select class="hero-filter-dp form-select no-select2 " name="marital_status">
                                                    <option value="" selected="">নির্বাচন করুন </option>
                                                    @foreach ($maritalstatuses as $maritalstatus)
                                                        <option value="{{ $maritalstatus->id }}"
                                                            {{ request()->get('marital_status') == $maritalstatus->id ? 'selected' : '' }}>
                                                            {{ $maritalstatus->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="marital-status home-input-item">
                                            <div class="box">
                                                <label>ধর্ম </label>
                                                <select class="hero-filter-dp form-select no-select2" name="religion">
                                                    <option value="" selected="">নির্বাচন করুন </option>
                                                    @foreach ($religions as $religion)
                                                        <option value="{{ $religion->id }}"
                                                            {{ request()->get('religion') == $religion->id ? 'selected' : '' }}>
                                                            {{ $religion->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="marital-status home-input-item">
                                            <div class="box">
                                                <label>বিভাগ </label>
                                                <select class="hero-filter-dp form-select no-select2" name="division">
                                                    <option value="" selected="">নির্বাচন করুন </option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->id }}"
                                                            {{ request()->get('division') == $location->id ? 'selected' : '' }}>
                                                            {{ $location->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!--<div class="bhomemodel home-input-item">-->
                                        <!--    <div class="box">-->
                                        <!--        <label for="from">বয়স (শুরু)</label>-->
                                        <!--        <select class="hero-filter-dp form-select" name="from">-->
                                        <!--            <option value="" selected="">নির্বাচন করুন </option>-->
                                        <!--            @for ($i = 18; $i <= 99; $i++) -->
                                        <!--            <option value="{{ $i }}" @if ($i == 18) selected @endif>{{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর </option>                                                    -->
                                        <!-- @endfor-->
                                        <!--        </select>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <!--<div class="religion home-input-item">-->
                                        <!--    <div class="box">-->
                                        <!--        <label for="to">বয়স (শেষ)</label>-->
                                        <!--        <select class="hero-filter-dp form-select" name="to">-->
                                        <!--            <option value="" selected="">নির্বাচন করুন </option>-->
                                        <!--            @for ($i = 18; $i <= 99; $i++) -->
                                        <!--            <option value="{{ $i }}" @if ($i == 99) selected @endif >{{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর </option>                                                    -->
                                        <!--  @endfor-->
                                        <!--        </select>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                    </div>
                                    <div class="form-submit">
                                        <button type="submit" class="btn su-form">খুঁজুন </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- ROW END  -->
            </div>
        </div>

        <div class='air air1'></div>
        <div class='air air2'></div>
        <div class='air air3'></div>
        <div class='air air4'></div>

        <div id="scroll-down-animation">
            <span class="mouse">
                <i class="fa fa-angle-down"></i>
            </span>
            <!--<h2>নিচে যান</h2>-->
        </div>
    </div>

    <div class="route-url">
        <div class="container">
            <div class="row justify-content-center ">

                <div class="col-sm-4">
                    <div class="idsearch">
                        <form id="breadcumbidsearch">
                            <div class="idinput">
                                <input type="text" class="search_keyword search_click" value="{{ request()->get('member_id') }}" id="memberId"
                                    name="member_id" placeholder="আইডি নাম্বার " />
                            </div>
                            <button type="submit"><i class="fa-solid fa-search"></i></button>
                        </form>
                        <div class="search_result"></div>
                    </div>
                </div>
                <div class="col-sm-4 d-none d-sm-block">
                    <div class="fitlers sticky">
                        <div class="filterbox">
                            <div class="filter-top">
                                <h2 id="filterDropdown"><i class="fa-solid fa-filter"></i> ফিল্টার  </h2>
                                <label for="reset-form"><a href="{{ route('home') }}">পরিবর্তন</a></label>
                            </div>
                            <div class="filter-bottom filter-show" style="display: none;">
                                <form id="filterform" name="searchForm">
                                    <input type="reset" id="reset-form" style="display: none;" />
                                    <div class="group">
                                        <div class="box age">
                                            <label for="from">বয়স (শুরু)</label>
                                            <select class=" hero-filter-dp form-select " id="from"
                                                name="from">
                                                <option value="">নির্বাচন করুন </option>
                                                @for ($i = 18; $i <= 99; $i++)
                                                    <option value="{{ $i }}"
                                                        @if ($i == request()->get('from')) selected @endif>
                                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="box age">
                                            <label for="to">বয়স (শেষ)</label>
                                            <select class="hero-filter-dp form-select" name="to" id="to">
                                                <option value="">নির্বাচন করুন </option>
                                                @for ($i = 18; $i <= 99; $i++)
                                                    <option value="{{ $i }}"
                                                        @if ($i == request()->get('to')) selected @endif>
                                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <div class="box gender">
                                            <label for="gender">বর বউ</label>
                                            <select class="hero-filter-dp form-select" name="gender" id="gender">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                <option value="1" {{ request()->get('gender') == 1 ? 'selected' : '' }}>বর
                                                </option>
                                                <option value="2" {{ request()->get('gender') == 2 ? 'selected' : '' }}>বউ
                                                </option>
                                            </select>
                                        </div>

                                        <div class="box cast">
                                            <label for="cast">বৈবাহিক অবস্থা</label>
                                            <select class="hero-filter-dp form-select" name="marital_status" id="marital_status">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                @foreach ($maritalstatuses as $marital)
                                                    <option value="{{ $marital->id }}"
                                                        {{ request()->get('marital_status') == $marital->id ? 'selected' : '' }}>
                                                        {{ $marital->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div class="box religion">
                                            <label for="gender">ধর্ম</label>
                                            <select class="hero-filter-dp form-select" name="religion" id="religion">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->id }}"
                                                        {{ request()->get('religion') == $religion->id ? 'selected' : '' }}>
                                                        {{ $religion->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="box education">
                                            <label for="gender">শিক্ষাগত যোগ্যতা</label>
                                            <select class="hero-filter-dp form-select" name="degree" id="degree">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                @foreach ($edulevels as $edulevel)
                                                    <option value="{{ $edulevel->id }}"
                                                        {{ request()->get('degree') == $edulevel->id ? 'selected' : '' }}>
                                                        {{ $edulevel->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="group">
                                        <div class="box education">
                                            <label for="profession">পেশাগত যোগ্যতা</label>
                                            <select class="hero-filter-dp form-select select2" name="profession" id="profession">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                @foreach ($professions as $profession)
                                                    <option value="{{ $profession->id }}"
                                                        {{ request()->get('profession') == $profession->id ? 'selected' : '' }}>
                                                        {{ $profession->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="box working">
                                            <label for="working">কর্মক্ষেত্র</label>
                                            <select class="hero-filter-dp form-select" name="working" id="working">
                                                <option value="" selected="">নির্বাচন করুন</option>
                                                @foreach ($workings as $working)
                                                    <option value="{{ $working->id }}"
                                                        {{ request()->get('working') == $working->id ? 'selected' : '' }}>
                                                        {{ $working->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="group">

                                        <div class="box residency">
                                            <label for="residency">আবাসস্থল </label>
                                            <select class="hero-filter-dp form-select" name="residency" id="residency">
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ request()->get('residency') == $country->id ? 'selected' : '' }}>
                                                        {{ $country->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="box district">
                                            <label for="division_id">বিভাগ </label>
                                            <select class="hero-filter-dp form-select" name="division" id="division_id">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}"
                                                        {{ request()->get('division') == $location->id ? 'selected' : '' }}>
                                                        {{ $location->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div class="box district">
                                            <label for="district">জেলা</label>
                                            <select class="hero-filter-dp form-select" id="district_id" name="district">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}"
                                                        {{ request()->get('district') == $district->id ? 'selected' : '' }}>
                                                        {{ $district->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="box residency">
                                            <label for="upazila_id">উপজেলা/থানা</label>
                                            <select class="hero-filter-dp form-select" id="upazila_id" name="upazila">
                                                <option value="" selected="">নির্বাচন করুন </option>

                                                @foreach ($upazilas as $upazila)
                                                    <option value="{{ $upazila->id }}"
                                                        {{ request()->get('upazila') == $upazila->id ? 'selected' : '' }}>
                                                        {{ $upazila->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box fltrsubmit sidefilter">
                                        <button type="submit" value="Filter" class="btn fltrbtn">খুঁজুন</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="search" id="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-content">
                        <div class="row search-result" id="loadmore-part">
                            @foreach ($members as $key => $value)
                                <div class="col-sm-4">
                                    <div class="seach-item">
                                        <a href="{{ route('member.details', $value->id) }}">
                                            <div class="prof_image">
                                                <div class="meter">
                                                    <span style="width: 60%;">60% Match</span>
                                                </div>
                                                <div class="f-img">
                                                    <img src="{{ asset($value->memberimage ? $value->memberimage->image_one : '') }}"
                                                        alt="" />
                                                </div>
                                            </div>
                                            <div class="f-info">
                                                <span class="member-id">আইডি নাম্বারঃ <span
                                                        class="count-number">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->id) }}</span></span>
                                                <span
                                                    class="name">{{ $value->fullName ?? '' }}</span>

                                            </div>
                                            <div class="person-info">
                                                <div class="p-details">
                                                    <ul>
                                                        <li class="residence">
                                                            <!--<p class="ml-text">বৈবাহিক অবস্থাঃ </p>-->
                                                            <p class="st-text">
                                                                {{ $value->basicinfo ? ($value->basicinfo->maritalstatus ? $value->basicinfo->maritalstatus->title : '') : '' }}
                                                            </p>
                                                        </li>

                                                        <li class="residence">
                                                            <!--<p class="ml-text">বয়সঃ </p>-->
                                                            <p class="st-text">
                                                                {{ App\Converter\enandbn\BanglaConverter::en2bn($value->basicinfo ? $value->basicinfo->age : '') }}
                                                                বছর</p>
                                                        </li>

                                                        <li class="religion">
                                                            <!--<p class="ml-text">ধর্মঃ</p>-->
                                                            <p class="st-text">
                                                                {{ $value->basicinfo ? $value->basicinfo->religion->title : '' }}
                                                            </p>
                                                        </li>

                                                        <li class="residence">
                                                            <!--<p class="ml-text">পেশাঃ </p>-->
                                                            <p class="st-text longest">
                                                                {{ $value->careerinfo ? ($value->careerinfo->profession ? $value->careerinfo->profession->title : '') : '' }}
                                                            </p>
                                                        </li>



                                                        <li class="religion">
                                                            <!--<p class="ml-text">বিভাগঃ</p>-->
                                                            <p class="st-text">
                                                                {{ $value->basicinfo->division->title ?? '' }}</p>
                                                        </li>


                                                        <li class="residence">
                                                            <!--<p class="ml-text">দেশঃ </p>-->
                                                            <p class="st-text">
                                                                {{ $value->basicinfo ? $value->basicinfo->recidency->title : '' }}
                                                            </p>
                                                        </li>



                                                    </ul>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @if ($key % 3 == 2)
                                    <div class="col-sm-12 my-4">
                                        <div class="google_ads text-center ">
                                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2119341173001568"
                                                crossorigin="anonymous"></script>
                                            <!-- Home page -->
                                            <ins class="adsbygoogle" style="display:block"
                                                data-ad-client="ca-pub-2119341173001568" data-ad-slot="2722493229"
                                                data-ad-format="auto" data-full-width-responsive="true"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || [])
                                                .push({});
                                            </script>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div id="loading-bar" class="circle-container">
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                    <div class="col-sm-12">
                        {{--
                    <div class="cust_pagination">
                        {!! $members->onEachSide(0)->appends(request()->query())->links('pagination::bootstrap-4') !!}
                    </div>
                    @if ($members->count() > 8)
                    <!--<div class="next_text">-->
                    <!-- <p>পরের পাতায় দেখুন</p>-->
                    <!--</div>-->
                    @endif
                    --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--<section class="featured" id="">-->
    <!--    <div class="container">-->
    <!--        <div class="featuredTop">-->
    <!--            <div class="right">-->
    <!--                <div class="tab bridetab">-->
    <!--                    <button class="tablinks active" id="groomBtn">-->
    <!--                        <span>বর</span>-->
    <!--                        <div class="btn-icon"><i class="fa fa-male"></i></div>-->
    <!--                    </button>-->
    <!--                    <button class="tablinks" id="brideBtn">-->
    <!--                        <span>বউ</span>-->
    <!--                        <div class="btn-icon"><i class="fa fa-female"></i></div>-->
    <!--                    </button>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--    <div class="featuredContent bridetab">-->
    <!-- Tab content -->

    <!--        <div id="males" class="tabcontent">-->
    <!--            <div class="maleslideContainer owl-carousel">-->
    <!--                        @foreach ($male_members as $value)
    -->
    <!--                        <div class="swiper-slide">-->
    <!--                            <a href="{{ route('member.details', $value->id) }}">-->
    <!--                                <div class="prof_image">                                    -->
    <!--                                    <div class="meter">-->
    <!--                                        <span style="width: 60%;">60% Match</span>-->
    <!--                                    </div>-->
    <!--                                    <div class="f-img">-->
    <!--                                        <img src="{{ asset($value->memberimage ? $value->memberimage->image_one : '') }}" alt="" />-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="f-info">-->
    <!--                                    <span class="member-id">আইডি নাম্বারঃ <span class="count-number">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->id) }}</span> </span>-->
    <!--                                    <span class="name">{{ $value->fullName ?? '' }}</span>-->
    <!--                                    <div class="f-into">-->
    <!--                                        <span class="marital-status">{{ $value->basicinfo ? ($value->basicinfo->maritalstatus ? $value->basicinfo->maritalstatus->title : '') : '' }} </span>-->
    <!--                                        <span class="designation">{{ $value->careerinfo ? ($value->careerinfo->profession ? $value->careerinfo->profession->title : '') : '' }}</span>-->
    <!--                                        <span class="residence">{{ $value->basicinfo ? $value->basicinfo->recidency->title : '' }}</span>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="person-info">-->
    <!--                                    <div class="p-details">-->
    <!--                                        <ul>-->
    <!--                                            <li class="age">-->
    <!--                                                <p class="ml-text">বয়সঃ </p>-->
    <!--                                                <p class="st-text">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->basicinfo ? $value->basicinfo->age : '') }} বছর</p>-->
    <!--                                            </li>-->

    <!--                                            <li class="religion">-->
    <!--                                                <p class="ml-text">ধর্মঃ</p>-->
    <!--                                                <p class="st-text">{{ $value->basicinfo ? $value->basicinfo->religion->title : '' }}</p>-->
    <!--                                            </li>-->
    <!--                                        </ul>-->
    <!--                                    </div>-->
    <!--                                    <button class="custom-btn-alt btn">-->
    <!--                                        দেখুন-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--
    @endforeach-->
    <!--                    </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div id="females" class="tabcontent">-->
    <!--            <div class="femaleslideContainer owl-carousel">-->
    <!--                        @foreach ($female_members as $value)
    -->
    <!--                        <div class="swiper-slide">-->
    <!--                            <a href="{{ route('member.details', $value->id) }}">-->
    <!--                                <div class="prof_image">                                    -->
    <!--                                    <div class="meter">-->
    <!--                                        <span style="width: 60%;">60% Match</span>-->
    <!--                                    </div>-->
    <!--                                    <div class="f-img">-->
    <!--                                        <img src="{{ asset($value->memberimage ? $value->memberimage->image_one : '') }}" alt="" />-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="f-info">-->
    <!--                                    <span class="member-id">আইডি নাম্বারঃ <span class="count-number">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->id) }}</span></span>-->
    <!--                                    <span class="name">{{ $value->fullName ?? '' }}</span>-->
    <!--                                    <div class="f-into">-->
    <!--                                        <span class="marital-status">{{ $value->basicinfo ? ($value->basicinfo->maritalstatus ? $value->basicinfo->maritalstatus->title : '') : '' }} </span>-->
    <!--                                        <span class="designation">{{ $value->careerinfo ? ($value->careerinfo->profession ? $value->careerinfo->profession->title : '') : '' }}</span>-->
    <!--                                        <span class="residence">{{ $value->basicinfo ? $value->basicinfo->recidency->title : '' }}</span>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="person-info">-->
    <!--                                    <div class="p-details">-->
    <!--                                        <ul>-->
    <!--                                            <li class="age">-->
    <!--                                                <p class="ml-text">বয়সঃ </p>-->
    <!--                                                <p class="st-text">{{ App\Converter\enandbn\BanglaConverter::en2bn($value->basicinfo ? $value->basicinfo->age : '') }} বছর</p>-->
    <!--                                            </li>-->

    <!--                                            <li class="religion">-->
    <!--                                                <p class="ml-text">ধর্মঃ</p>-->
    <!--                                                <p class="st-text">{{ $value->basicinfo ? $value->basicinfo->religion->title : '' }}</p>-->
    <!--                                            </li>-->
    <!--                                        </ul>-->
    <!--                                    </div>-->
    <!--                                    <button class="custom-btn-alt btn">-->
    <!--                                        দেখুন-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--
    @endforeach-->
    <!--                    </div> -->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <!--<section class="how_register_sec">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-sm-12">-->
    <!--                <div class="how_register">-->
    <!--                   <a href="https://youtube.com/shorts/iousB1iUckM" target="_blank"> <span>কিভাবে রেজিস্ট্রেশন করবেন</span>  <i class="fab fa-youtube" aria-hidden="true"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->


    @if (Auth::guard('member')->user())
        @if (Auth::guard('member')->user()->publish == 0)
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#staticBackdrop').modal('show');
                });
            </script>
        @endif
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        let page = 1;
        let loading = false;

        function isMobile() {
            return window.innerWidth <= 768;
        }

        function getScrollTriggerHeight() {
            return isMobile() ? 1200 : 400;
        }
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - getScrollTriggerHeight()) {
                if (!loading) {
                    loading = true;
                    $('#loading-bar').show();
                    page++;
                    loadMoreNews(page);
                }
            }
        });

        function loadMoreNews(page) {
            var gender = $('#gender').val();
            var fromAge = $('#from').val();
            var toAge = $('#to').val();
            var maritalStatus = $('#marital_status').val();
            var religion = $('#religion').val();
            var degree = $('#degree').val();
            var profession = $('#profession').val();
            var working = $('#working').val();
            var residency = $('#residency').val();
            var division = $('#division_id').val();
            var district = $('#district_id').val();
            var upazila = $('#upazila_id').val();
            var memberId = $('#memberId').val();
            $.ajax({
                url: '{{ route('member.loadmore') }}',
                type: 'GET',
                data: {
                    page: page,
                    gender: gender,
                    from: fromAge,
                    to: toAge,
                    marital_status: maritalStatus,
                    religion: religion,
                    degree: degree,
                    profession: profession,
                    working: working,
                    residency: residency,
                    division: division,
                    district: district,
                    upazila: upazila,
                    member_id: memberId
                },
                success: function(response) {
                    if (response) {
                        $('#loadmore-part').append(response);
                        loading = false;
                        $('#loading-bar').hide();
                    } else {
                        $('#loading-bar').hide();
                    }
                }
            });
        }
    </script>
    <script>
            // JavaScript to display the device width
            function displayDeviceWidth() {
                const width = window.innerWidth;
                document.getElementById('device-width').textContent = width;
            }
    
            // Call the function on page load
            displayDeviceWidth();
    
            // Optionally, update the width when the window is resized
            window.addEventListener('resize', displayDeviceWidth);
        </script>

@endsection
