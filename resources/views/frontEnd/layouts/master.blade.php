<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> Bor Bou - The Best Matrimony Website in Bangladesh | Register Now! </title>

    <!-- Meta Tags for SEO and Open Graph -->
    <meta name="description"
        content="Bor Bou - The Best Matrimony Website in Bangladesh | Register Now! Join the Top Online Marriage Media and Find Your Perfect Life Partner." />
    <meta name="author" content="borbou">
    <link rel="canonical" href="https://borbou.com.bd" />
    <meta name="robots" content="index, follow">
    <meta name="keywords"
        content="Matrimony Website, Marriage Website, Wedding Website, Matrimonial Website, Online Matrimony, Bengali Matrimony, Bangladeshi Matrimony Website, Bangladeshi Matrimonial Website, BorBou, BorBou.com.bd, Matrimony, Matrimonial, Marriage Media, Bangladesh Matrimony, Bride and Groom, বর বউ, বিয়ের ওয়েবসাইট, বিবাহের ওয়েবসাইট, বর বউ চাই, পাত্র পাত্রী চাই, বিধবা পাত্রী চাই, ডিভোর্সি পাত্রী চাই, ইসলামিক বিয়ের ওয়েবসাইট, ম্যাট্রিমনি, পাত্রপাত্রী, ম্যারেজমিডিয়া">
    <meta property="og:url" content="https://borbou.com.bd" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Bor Bou - The Best Matrimony Website in Bangladesh | Register Now!" />
    <meta property="og:description"
        content="Bor Bou - The Best Matrimony Website in Bangladesh | Register Now! Join the Top Online Marriage Media and Find Your Perfect Life Partner." />
    <meta property="og:image" content="{{ asset('public/frontEnd') }}/images/og-image.png" />

    <!-- Favicon and Icons -->
    <link rel="shortcut icon" href="{{ asset($generalsetting->favicon) }}" />
    <link rel="icon" rel="apple-touch-icon" href="{{ asset('public/frontEnd') }}/images/og-image.png" />

    <!-- Fonts and Stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/chosen.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/jquery.uploader.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/css/icons.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/icofont.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/nice-select.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/libs/dropify/css/dropify.min.css" />
    <link href="{{ asset('public/backEnd/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/css/toastr.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/style.css?v=3.0.10" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/responsive.css?v=3.0.10" />
    <meta name="facebook-domain-verification" content="dk4jtrup3sgo73epggz3kbdauuqrhh" />

    <!-- Facebook and Google Tags -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '882194303609129');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=882194303609129&ev=PageView&noscript=1" /></noscript>

    <!-- Google Analytics and AdSense -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GC5X06ZZP0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GC5X06ZZP0');
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2119341173001568"
        crossorigin="anonymous"></script>
    <meta name="google-adsense-account" content="ca-pub-2119341173001568">
</head>

<body class="gotop">
    <!-- bottom navigation part starts -->
    <div class="menu-container">
        <div class="inner">

            <div class="menu-item  active-red" id="filterButton">
                <i class="fa-solid fa-filter"></i>
            </div>
            <div class="menu-item {{ Route::is('contact') ? 'active' : '' }} active-yellow"
                data-url="{{ route('member.messages') }}">
                <a href="{{ route('member.messages') }}">
                    <i class="fa-solid fa-message"></i>
                </a>
            </div>
            <div class="menu-item {{ Route::is('home') ? 'active' : '' }} active-red" data-url="{{ route('home') }}"
                id="homeLink">
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-heart"></i>
                </a>
            </div>

            <div class="menu-item {{ Route::is('member.wishlist') ? 'active' : '' }} active-yellow"
                data-url="{{ route('member.wishlist') }}">
                <a href="{{ route('member.wishlist') }}" class="wishlist-link-button">
                    <span class="wishCount">@include('frontEnd.layouts.ajax.wishcount')</span>
                    <i class="fa-solid fa-star"></i>
                </a>
            </div>

            @if (Auth::guard('member')->user())
                <div class="menu-item {{ Route::is('member.editprofile') ? 'active' : '' }} active-red"
                    data-url="{{ route('member.editprofile') }}">
                    <a href="{{ route('member.editprofile') }}">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
            @else
                <div class="menu-item {{ Route::is('member.login') ? 'active' : '' }} active-red"
                    data-url="{{ route('member.login') }}">
                    <a href="{{ route('member.login') }}">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
            @endif
        </div>
        <div class="inner">
            <div class="menu-item  active-yellow">
                <p>ফিল্টার</p>
            </div>
            <div class="menu-item {{ Route::is('contact') ? 'active' : '' }} active-red"
                data-url="{{ route('member.messages') }}">
                <a href="{{ route('member.messages') }}">
                    <p>যোগাযোগ</p>
                </a>
            </div>

            <div class="menu-item {{ Route::is('home') ? 'active' : '' }} active-red" data-url="{{ route('home') }}"
                id="homeLink">
                <a href="{{ route('home') }}">
                    <p>বর বউ</p>
                </a>
            </div>

            <div class="menu-item {{ Route::is('member.wishlist') ? 'active' : '' }} active-yellow"
                data-url="{{ route('member.wishlist') }}">
                <a href="{{ route('member.wishlist') }}" class="wishlist-link-button">
                    <p>বায়োডাটা</p>
                </a>
            </div>

            @if (Auth::guard('member')->user())
                <div class="menu-item {{ Route::is('member.editprofile') ? 'active' : '' }} active-red"
                    data-url="{{ route('member.editprofile') }}">
                    <a href="{{ route('member.editprofile') }}">
                        <p>একাউন্ট</p>
                    </a>
                </div>
            @else
                <div class="menu-item {{ Route::is('member.login') ? 'active' : '' }} active-red"
                    data-url="{{ route('member.login') }}">
                    <a href="{{ route('member.login') }}">
                        <p>লগিন</p>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- bottom navigation part ends -->
    @yield('content')
    @if (url()->current() != route('home'))
        <!--<footer class="area-bg-one footer-area">-->
        <!--    <div class="">-->
        <!--        {{---->
        <!--        <div class="footer-top">-->
        <!--            <div class="container">-->
        <!--                <div class="row">-->
        <!--                    <div class="col-sm-3  mb-sm-0">-->
        <!--                        <div class="footer-about">-->
        <!--                            <a href="{{ route('home') }}">-->
        <!--                                <img src="{{ asset($generalsetting->white_logo) }}" alt="" />-->
        <!--                            </a>-->
        <!--                            <p>{{ $contact->address }}</p>-->
        <!--                            <a href="tel:{{ $contact->hotline }}"-->
        <!--                                class="footer-hotlint">{{ $contact->hotline }}</a>-->
        <!--                        </div>-->
        <!--                    </div>-->
                            <!-- col end -->
        <!--                    <div class="col-sm-3 mb-3 mb-sm-0 col-6">-->
        <!--                        <div class="footer-menu">-->
        <!--                            <ul>-->
        <!--                                <li class="title"><a>Bor Bou</a></li>-->
        <!--                                @foreach ($footer_left as $leftmenu)-->
        <!--                                    <li><a-->
        <!--                                            href="{{ route('page.show', $leftmenu->slug) }}">{{ $leftmenu->name }}</a>-->
        <!--                                    </li>-->
        <!--                                @endforeach-->
        <!--                                <li><a href="{{ route('contact') }}">যোগাযোগ করুন</a></li>-->

        <!--                            </ul>-->
        <!--                        </div>-->
        <!--                    </div>-->
                            <!-- col end -->
        <!--                    <div class="col-sm-3 mb-3 mb-sm-0 col-6">-->
        <!--                        <div class="footer-menu">-->
        <!--                            <ul>-->
        <!--                                <li class="title"><a>Links</a></li>-->
        <!--                                @foreach ($footer_right as $rightmenu)-->
        <!--                                    <li><a-->
        <!--                                            href="{{ route('page.show', $rightmenu->slug) }}">{{ $rightmenu->name }}</a>-->
        <!--                                    </li>-->
        <!--                                @endforeach-->
        <!--                            </ul>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-sm-3 mb-sm-0">-->
        <!--                        <div class="footer-menu">-->
        <!--                            <ul>-->
        <!--                                <li class="title stay_conn"><a>Stay Connected</a></li>-->
        <!--                            </ul>-->
        <!--                            <ul class="social_link">-->
        <!--                                @foreach ($socialicons as $value)-->
        <!--                                    <li class="social_list">-->
        <!--                                        <a class="mobile-social-link" href="{{ $value->link }}"><i-->
        <!--                                                class="{{ $value->icon }}"></i></a>-->
        <!--                                    </li>-->
        <!--                                @endforeach-->
        <!--                            </ul>-->
                                    <!--<div class="d_app">-->
                                    <!--    <h2>Download App</h2>-->
                                    <!--    <a href="{{ asset('public/frontEnd') }}/images/BorBou.apk">-->
                                    <!--        <img src="{{ asset('public/frontEnd/images/app-download.png') }}" alt="">-->
                                    <!--    </a>-->
                                    <!--</div>-->
        <!--                        </div>-->
        <!--                    </div>-->
                            <!-- col end -->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        --}}-->
                <!--<div class="footer-bottom">-->
                <!--    <div class="">-->
                <!--        <div class=" text-center">-->
                <!--            <div class="copyright">-->
                <!--                <p>Copyright © {{ date('Y') }} Bor Bou | All Rights Reserved</p>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
        <!--    </div>-->
        <!--</footer>-->
    @endif

    <div class="scrolltop" style="">
        <div class="scroll">
            <i class="fa fa-angle-up"></i>
        </div>
    </div>

    <div class="app-release-btn " style="">
        <a href="{{ route('contact') }}" style="">
            <img src="{{ asset('public/frontEnd/images/headphone-1.png') }}" style="" />
        </a>
    </div>

    <div class="message-floating-btn " style="">
        <a href="{{ route('member.messages') }}">
            <i class="fa fa-message"></i>
        </a>
    </div>



    <div id="page-overlay"></div>
    <div class="filter-bottom filter-show master-filter " style="" id="masterFilter">
        <form id="filterform" name="searchForm" action="{{ route('home') }}">
            <input type="reset" id="reset-form" style="display: none;" />
            <div class="group">
                <div class="box age">
                    <label for="from">বয়স (শুরু)</label>
                    <select class=" hero-filter-dp form-select " id="from" name="from">
                        <option value="">নির্বাচন করুন </option>
                        @for ($i = 18; $i <= 99; $i++)
                            <option value="{{ $i }}" @if ($i == request()->get('from')) selected @endif>
                                {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="box age">
                    <label for="to">বয়স (শেষ)</label>
                    <select class="hero-filter-dp form-select " name="to" id="to">
                        <option value="">নির্বাচন করুন </option>
                        @for ($i = 18; $i <= 99; $i++)
                            <option value="{{ $i }}" @if ($i == request()->get('to')) selected @endif>
                                {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="group">
                <div class="box gender">
                    <label for="gender">বর বউ</label>
                    <select class="hero-filter-dp form-select " name="gender" id="gender">
                        <option value="" selected="">নির্বাচন করুন </option>
                        <option value="1" {{ request()->get('gender') == 1 ? 'selected' : '' }}>বর
                        </option>
                        <option value="2" {{ request()->get('gender') == 2 ? 'selected' : '' }}>বউ
                        </option>
                    </select>
                </div>

                <div class="box cast">
                    <label for="cast">বৈবাহিক অবস্থা</label>
                    <select class="hero-filter-dp form-select " name="marital_status" id="marital_status">
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
                    <select class="hero-filter-dp form-select " name="religion" id="religion">
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
                    <select class="hero-filter-dp form-select " name="degree" id="degree">
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
                    <select class="hero-filter-dp form-select select2 " name="profession" id="profession">
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
                    <select class="hero-filter-dp form-select " name="working" id="working">
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
                    <select class="hero-filter-dp form-select " name="residency" id="residency">
                        <option value="">নির্বাচন করুন </option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ request()->get('residency') == $country->id ? 'selected' : '' }}>
                                {{ $country->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="box district">
                    <label for="division_id2">বিভাগ </label>
                    <select class="hero-filter-dp form-select " name="division" id="division_id2">
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
                    <label for="district2">জেলা</label>
                    <select class="hero-filter-dp form-select  " id="district_id2" name="district">
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
                    <select class="hero-filter-dp form-select " id="upazila_id" name="upazila">
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
                <a class="btn text-white midnight-blue d-block text-center filter-change-button"
                    href="{{ route('home') }}">
                    <!--<i style="font-size: 25px;" class="fa-solid fa-eraser midnight-blue-color p-2 rounded-3"></i>-->
                    পরিবর্তন
                </a>
            </div>
        </form>
    </div>
    @php
        $conversation = Session::get('conversations', []);
        foreach ($conversation as $message) {
            echo $message . '<br>'; // Display each message
        }
    @endphp
    <span class="d-none">{{ request()->ip() }} </span>

    {{-- @if (Auth::guard('member')->user())
        @php
            $conversation_id = Session::get('conversation_id');
            $has_conversation = Session::has('conversation_id');
            $loggedInMemberId = Auth::guard('member')->user()->id;
            if ($conversation_id) {
                $conversation = \App\Models\Conversation::with('member_one', 'member_two')->find($conversation_id);
                if (!$conversation) {
                    return response()->json(['error' => 'Conversation not found'], 404);
                }
                $record = \App\Models\Conversation::where('member_one_id', $loggedInMemberId)->first();
                $conversationMemberImage = $record
                    ? $conversation->member_two->memberimage->image_one
                    : $conversation->member_one->memberimage->image_one;
                // echo $conversation;
                echo $conversation_id;
            }
        @endphp

        <div class="position-fixed message-popup-wrapper {{ $conversation_id ? '' : 'd-none' }}">
            <div class="message-popup-inner" style="{{ $has_conversation ? 'display: block;' : '' }}">
                <div class="message-popup-header">
                </div>
                <div class="message-popup-body">
                    <ul id="messageBox"></ul>
                </div>
                <div class="message-popup-control">
                    <div class="inner">
                        <div class="input">
                            <input type="text" class="message-content" name="content">
                        </div>
                        <div class="submit">
                            @if ($conversation)
                                <button class="message-send" data-id="{{ $conversation->id ?? '' }}">
                                    @include('frontEnd.svg.send')
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}

    <!-- script part -->
    <!-- bootstrap script -->
    <script src="{{ asset('public/frontEnd/') }}/js/bootstrap.bundle.min.js"></script>
    <!-- jquery script -->
    <script src="{{ asset('public/frontEnd/') }}/js/jquery.min.js"></script>
    <!-- nice select -->
    <script src="{{ asset('public/frontEnd/') }}/js/chosen.jquery.js"></script>
    <!-- nice select -->
    <script src="{{ asset('public/frontEnd/') }}/js/jquery.uploader.min.js"></script>

    <!--owl carousel js-->
    <script src="{{ asset('public/frontEnd/') }}/js/owl.carousel.min.js"></script>
    <!-- dropify -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs/dropify/js/dropify.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <script>
        feather.replace();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/jquery.nice-select.min.js"></script>
    <!-- youtube bg player -->
    <script src="{{ asset('public/frontEnd/') }}/js/jquery.youtube-background.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <!-- toastr -->
    <script src="{{ asset('public/backEnd/') }}/assets/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="{{ asset('public/frontEnd/') }}/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('.menu-item').on('click', function() {
                // Get the URL from the data-url attribute
                var url = $(this).data('url');

                // Redirect to the URL
                if (url) {
                    window.location.href = url;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#scroll-down-animation").click(function() {
                // Check the screen width
                let scrollTarget = window.innerWidth < 400 ? 600 : 520; // Adjust the scroll target based on screen width
                // Scroll to the target position

                $("html, body").animate({
                    scrollTop: scrollTarget
                }, 100); // Adjust animation duration as needed
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('[data-vbg]').youtube_background();
        });

        $(document).ready(function() {
            $('.nice-select').niceSelect();
        });

        $(document).ready(function() {
            function activateSelect2() {
                if ($(window).width() > 500) {
                    $('.select2').select2(); // Initialize Select2 on elements with class 'select2-element'
                } else {
                    // Destroy Select2 if already initialized and width is <= 500px
                    if ($('.select2').hasClass('select2-hidden-accessible')) {
                        $('.select2').select2('destroy');
                    }
                }
            }

            // Initial check
            activateSelect2();

            // Re-check on window resize
            $(window).resize(function() {
                activateSelect2();
            });
        });

        document.onkeydown = function(e) {
            if (e.ctrlKey && (e.keyCode === 85)) {
                return false;
            }

        };
        document.oncontextmenu = function(e) {
            e.preventDefault(); // Prevent the right-click menu from showing
        };

        let timeout;

        document.addEventListener('touchstart', function(event) {
            timeout = setTimeout(function() {
                event.preventDefault(); // Prevent long press behavior
            }, 500); // Set the long press time (500ms in this case)
        });

        document.addEventListener('touchend', function() {
            clearTimeout(timeout); // Cancel if touch ends before long press
        });

        $(".chosen-select").chosen();
        $('.dropify').dropify();
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            //>=, not <=
            if (scroll >= 500) {
                //clearHeader, not clearheader - caps H
                $(".top").addClass("fixed");
            } else {
                $(".top").removeClass("fixed");
            }
        }); //missing );



        // Slider Initialization--------------
        var featureSlide = new Swiper(".featureSlide", {
            slidesPerView: 1,
            loop: true,
            autoplay: true,
            centeredSlides: true,
            spaceBetween: 20,
            grabCursor: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                680: {
                    slidesPerView: 1.5,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 1.9,
                    spaceBetween: 30,
                },
                1170: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1600: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                }
            },
        });
        $('#males').show();
        $('#females').hide();

        $("#brideBtn").click(function() {
            $('#males').hide();
            $('#males').removeClass("show");
            $('#females').show();
            $('#females').addClass("show");
            $(this).addClass("active");
            $("#groomBtn").removeClass("active");
        });
        $("#groomBtn").click(function() {
            $('#males').show();
            $('#males').addClass("show");
            $('#females').hide();
            $('#females').removeClass("show");
            $(this).addClass("active");
            $("#brideBtn").removeClass("active");
        });

        $(document).ready(function() {
            $(".atin-btn").click(function() {
                var html = $(".atnclone").html();
                $(".atincrement").after(html);
            });

            $("body").on("click", ".atdel-btn", function() {
                $(this).parents(".removeatn").remove();
            });
            $("body").on("click", "#filterButton", function() {
                $(this).toggleClass('active');
                if ($("#homeLink").hasClass('active')) {
                    $("#homeLink").removeClass('active');
                }
                $("#masterFilter").toggleClass("active");

                if ($("#page-overlay").css("display") === "none") {
                    $("#page-overlay").css("display", "block");
                    $('body').addClass('overflow-none');
                } else {
                    $("#page-overlay").css("display", "none");
                    $('body').removeClass('overflow-none');
                }

                // if ($("html").css("overflow") === "hidden") {
                //     $("html").css("overflow", "auto");
                // } else {
                //     $("html").css("overflow", "hidden");
                // }
            });

            $(document).ready(function() {
                $("#yourButtonID").click(function() {
                    // Toggle overflow based on current state

                });
            });
        });

        // educational level
        $(".education_level").change(function() {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax-education-degree') }}?level_id=" + ajaxId,
                    success: function(res) {
                        if (res) {
                            $(".degree_id").empty();
                            $(".degree_id").append('<option value="">নির্বাচন করুন..</option>');
                            $.each(res, function(key, value) {
                                $(".degree_id").append('<option value="' + key + '">' + value +
                                    "</option>");
                            });
                        } else {
                            $(".degree_id").empty();
                        }
                    },
                });
            } else {
                $(".degree_id").empty();
                $(".degree_id").empty();
            }
        });

        // permanent address
        // district selection
        $("#division_id, #division_id2").change(function() {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax-location-district') }}?division_id=" + ajaxId,
                    success: function(res) {
                        if (res) {
                            $("#district_id, #district_id2").empty();
                            $("#district_id, #district_id2").append(
                                '<option value="">নির্বাচন করুন </option>');
                            $.each(res, function(key, value) {
                                $("#district_id, #district_id2").append('<option value="' +
                                    key + '">' +
                                    value + "</option>");
                            });
                        } else {
                            $("#district_id, #district_id2").empty();
                        }
                    },
                });
            } else {
                $("#district_id, #district_id2").empty();
                $("#district_id, #district_id2").empty();
            }
        });

        // upazila selection
        $("#district_id, #district_id2").change(function() {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax-location-upazila') }}?district_id=" + ajaxId,
                    success: function(res) {
                        if (res) {
                            $("#upazila_id, #upazila_id2").empty();
                            $("#upazila_id, #upazila_id2").append(
                                '<option value=""> নির্বাচন করুন </option>');
                            $.each(res, function(key, value) {
                                $("#upazila_id, #upazila_id2").append('<option value="' + key +
                                    '">' + value +
                                    "</option>");
                            });
                        } else {
                            $("#upazila_id, #upazila_id2").empty();
                        }
                    },
                });
            } else {
                $("#upazila_id, #upazila_id2").empty();
                $("#upazila_id, #upazila_id2").empty();
            }
        });



        // present address
        // district selection
        $("#present_division").change(function() {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax-location-district') }}?division_id=" + ajaxId,
                    success: function(res) {
                        if (res) {
                            $("#present_district").empty();
                            $("#present_district").append('<option value="">নির্বাচন করুন </option>');
                            $.each(res, function(key, value) {
                                $("#present_district").append('<option value="' + key + '">' +
                                    value + "</option>");
                            });
                        } else {
                            $("#present_district").empty();
                        }
                    },
                });
            } else {
                $("#present_district").empty();
                $("#present_district").empty();
            }
        });

        // upazila selection
        $("#present_district").change(function() {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax-location-upazila') }}?district_id=" + ajaxId,
                    success: function(res) {
                        if (res) {
                            $("#present_upazila").empty();
                            $("#present_upazila").append('<option value="">নির্বাচন করুন </option>');
                            $.each(res, function(key, value) {
                                $("#present_upazila").append('<option value="' + key + '">' +
                                    value + "</option>");
                            });
                        } else {
                            $("#present_upazila").empty();
                        }
                    },
                });
            } else {
                $("#present_upazila").empty();
                $("#present_upazila").empty();
            }
        });
    </script>

    @yield('script')
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "115630054803155");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v16.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.scrolltop:hidden').stop(true, true).fadeIn();
            } else {
                $('.scrolltop').stop(true, true).fadeOut();
            }
        });

        $(function() {
            $(".scroll").click(function() {
                $("html,body").animate({
                    scrollTop: $(".gotop").offset().top
                }, "1000");
                return false
            })
        })
    </script>
    <script>
        $(".search_click").on("keyup change", function() {
            var keyword = $(".search_keyword").val();
            $.ajax({
                type: "GET",
                data: {
                    keyword: keyword
                },
                url: "{{ route('livesearch') }}",
                success: function(products) {
                    if (products) {
                        $(".search_result").html(products);
                    } else {
                        $(".search_result").empty();
                    }
                },
            });
        });
    </script>

</body>

</html>
