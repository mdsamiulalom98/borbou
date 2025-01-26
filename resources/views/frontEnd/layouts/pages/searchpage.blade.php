@extends('frontEnd.layouts.master')
@section('title', '')
@section('content')
    @include('frontEnd.layouts.navigation')
    <div class="route-url">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <ul class="url-list">
                        <li><a href="{{ route('home') }}" class="url-link">হোম &nbsp;</a></li>
                        <li>
                            <p>/ সার্চ ও ফিল্টার</p>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <div class="idsearch">
                        <form id="breadcumbidsearch">
                            <div class="idinput">
                                <i class="icofont-id"></i>
                                <input type="text" id="bID" name="member_id"
                                    placeholder="আইডি নাম্বার দিয়ে খুঁজুন" />
                            </div>
                            <button type="submit">খুঁজুন</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="fitlers sticky">
                        <div class="filterbox">
                            <div class="filter-top">
                                <h2 id="filterDropdown"><i class="icofont-filter"></i>ফিল্টার</h2>
                                <label for="reset-form"><a href="{{ route('searchPage') }}">রিসেট</a></label>
                            </div>
                            <div class="filter-bottom filter-show" style="display: none;">
                                <form id="filterform" name="searchForm">
                                    <input type="reset" id="reset-form" style="display: none;" />
                                    <div class="group">
                                        <div class="box age">
                                            <label for="from">বয়স (শুরু)</label>
                                            <select class="select2 hero-filter-dp form-select " id="from"
                                                name="from">
                                                <option value="">নির্বাচন করুন </option>
                                                @for ($i = 18; $i <= 99; $i++)
                                                    <option value="{{ $i }}"
                                                        @if ($i == 18) selected @endif>
                                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="box age">
                                            <label for="to">বয়স (শেষ)</label>
                                            <select class="hero-filter-dp form-select select2" name="to"
                                                id="to">
                                                <option value="">নির্বাচন করুন </option>
                                                @for ($i = 18; $i <= 99; $i++)
                                                    <option value="{{ $i }}"
                                                        @if ($i == 99) selected @endif>
                                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }} বছর </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <div class="box gender">
                                            <label for="gender">বর বউ</label>
                                            <select class="hero-filter-dp form-select select2" name="gender">
                                                <option value="" selected="">নির্বাচন করুন </option>
                                                <option value="1"
                                                    {{ request()->get('gender') == 1 ? 'selected' : '' }}>বর
                                                </option>
                                                <option value="2"
                                                    {{ request()->get('gender') == 2 ? 'selected' : '' }}>বউ
                                                </option>
                                            </select>
                                        </div>

                                        <div class="box cast">
                                            <label for="cast">বৈবাহিক অবস্থা</label>
                                            <select class="hero-filter-dp form-select select2" name="marital_status">
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
                                            <select class="hero-filter-dp form-select select2" name="religion">
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
                                            <select class="hero-filter-dp form-select select2" name="degree">
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
                                            <select class="hero-filter-dp form-select select2" name="profession">
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
                                            <select class="hero-filter-dp form-select select2" name="working">
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
                                            <select class="hero-filter-dp form-select select2" name="residency">
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
                                            <select class="hero-filter-dp form-select select2" name="division"
                                                id="division_id">
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
                                            <select class="hero-filter-dp form-select select2 " id="district_id"
                                                name="district">
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
                                            <select class="hero-filter-dp form-select select2" id="upazila_id"
                                                name="upazila">
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
                        <div class="search-result">
                            @foreach ($members as $key => $value)
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
                                            <span class="member-id">আইডি নাম্বারঃ {{ $value->id }}</span>
                                            <span
                                                class="name">{{ $value->basicinfo ? $value->basicinfo->fullName : '' }}</span>
                                            <div class="f-into">
                                                <span
                                                    class="marital-status">{{ $value->basicinfo ? ($value->basicinfo->maritalstatus ? $value->basicinfo->maritalstatus->title : '') : '' }}
                                                </span>
                                                <span
                                                    class="designation">{{ $value->careerinfo ? ($value->careerinfo->profession ? $value->careerinfo->profession->title : '') : '' }}</span>
                                                <span
                                                    class="residence">{{ $value->basicinfo ? $value->basicinfo->recidency->title : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="person-info">
                                            <div class="p-details">
                                                <ul>
                                                    <li class="age">
                                                        <p class="ml-text">বয়সঃ </p>
                                                        <p class="st-text">
                                                            {{ App\Converter\enandbn\BanglaConverter::en2bn($value->basicinfo ? $value->basicinfo->age : '') }}
                                                            বছর</p>
                                                    </li>

                                                    <li class="religion">
                                                        <p class="ml-text">ধর্মঃ</p>
                                                        <p class="st-text">
                                                            {{ $value->basicinfo ? $value->basicinfo->religion->title : '' }}
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <button class="custom-btn-alt btn">
                                                দেখুন
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="cust_pagination">
                            {!! $members->onEachSide(0)->appends(request()->query())->links('pagination::bootstrap-4') !!}
                        </div>
                        <div class="next_text">
                            <p>পরের পাতায় দেখুন</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    @include('frontEnd.layouts.paymentmodal')

    <script type="text/javascript">
        document.forms["editForm"].elements["from"].value = 18;
        document.forms["editForm"].elements["to"].value = 99;
    </script>
@endsection
