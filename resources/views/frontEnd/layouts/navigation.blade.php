<div class="page-header">
    <header class="header" id="header">
        <div class="top ">
            <div class="container">
                <div class="topmenu">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img id="darkLogo" src="{{ asset($generalsetting->dark_logo) }}" alt="">
                        </a>
                    </div>
                    <div class="nav-right">
                        <div class="desktop">
                            <div class="nav">
                                <ul>
                                    <li><a href="{{ route('home') }}">প্রথম পাতা </a></li>
                                    
                                </ul>
                            </div>
                            <div class="login">
                                <ul>
                                    @if (Auth::guard('member')->user() != '')
                                        <li><a href="{{ route('member.editprofile') }}" class="btn" id="register"><i
                                                    class="fa fa-address-card"></i> একাউন্ট </a></li>
                                        <li><a href="{{ route('member.logout') }}" class="btn logout-bg"><i
                                                    class="fa-power-off fa-solid"></i> লগ আউট</a></li>
                                    @else
                                        <li><a href="{{ route('member.register') }}" class="mobile-buttons btn"
                                                id="register"><i class="fa fa-address-card"></i> রেজিস্ট্রেশন </a></li>
                                        <li><a href="{{ route('member.login') }}" class="mobile-buttons btn"
                                                id="login"><i class="icofont-user-alt-7"></i> লগইন </a></li>
                                    @endif
                                    <li><a href="{{ route('wishlist') }}" class="download"><i class="fa fa-heart"
                                                aria-hidden="true"></i>
                                            <span>{{ Cart::instance('wishlist')->count() }}</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="desktop mob">
                            <div class="nav">
                                <ul>
                                    <li class="mobile-link"><a class="mobile-buttons text-white red"
                                            href="{{ route('home') }}"><i class="fa fa-house-user pr-1"></i> প্রথম পাতা
                                        </a></li>
                                    
                                    @if (Auth::guard('member')->user() && Auth::guard('visitor')->user() == '')
                                        <li class="mobile-link"><a class="mobile-buttons text-white midnight-blue"
                                                href="{{ route('member.editprofile') }}"><i
                                                    class="fa fa-address-card pr-1"></i> একাউন্ট </a></li>
                                        <li class="mobile-link"><a class="mobile-buttons yellow"
                                                href="{{ route('member.logout') }}"><i class="icofont-logout pr-1"></i>
                                                লগ আউট </a></li>
                                    @elseif(Auth::guard('visitor')->user() && Auth::guard('member')->user() == '')
                                        <li class="mobile-link"><a href="{{ route('visitor.account') }}">একাউন্ট </a>
                                        </li>
                                    @else
                                        <li class="mobile-link"><a class="mobile-buttons text-white midnight-blue"
                                                href="{{ route('member.register') }}"><i
                                                    class="fa fa-address-card pr-1"></i> রেজিস্ট্রেশন</a></li>
                                        <li class="mobile-link"><a class="mobile-buttons  yellow"
                                                href="{{ route('member.login') }}"><i
                                                    class="icofont-user-alt-7 pr-1"></i> লগিন </a></li>
                                    @endif
                                    <li class="d-flex align-items-center"><a href="{{ route('wishlist') }}"
                                            class="download"><i class="fa fa-heart" aria-hidden="true"></i> <span
                                                class="wishlist-count">{{ Cart::instance('wishlist')->count() }}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
