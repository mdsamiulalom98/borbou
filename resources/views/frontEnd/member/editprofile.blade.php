@extends('frontEnd.layouts.master')
@section('title', '')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    @include('frontEnd.layouts.navigation')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 pb-3">
                    <div class="profile-right">
                        <div class="tab-teaser">
                            <div class="tab-wrapper">
                                <div class="tab-sidebar">
                                    <ul>
                                        @if (Auth::guard('member')->user()->publish == 1)
                                            <li class=""><a href="{{ url('member/download') }}"
                                                    class="red text-white"><i class="fa fa-heart d-inline-block"
                                                        style="margin-right: 2px;"></i> বর বউ </a></li>
                                        @else
                                            <li class="">
                                                <form action="{{ route('member.member_publish') }}" method="POST">
                                                    @csrf
                                                    <button
                                                        style="font-size: 15px;font-family: 'Potro Sans Bangla', sans-serif;background-color: #ff0000;color: #ffffff;width: 100%;font-weight: 600;padding: 7px 0px 7px;height: 40px;line-height: 15px;"
                                                        class="btn">
                                                        <i class="fa-solid fa-dollar d-inline-block "></i>
                                                        পেমেন্ট করুন</button>
                                                </form>
                                            </li>
                                        @endif
                                        <li><a href="javascript:void()" class="midnight-blue text-white" id="enableBtn"><i
                                                    class="fa-solid fa-pen-to-square d-inline-block "
                                                    style="margin-right: 2px;"></i> সংশোধন </a></li>
                                        <li><a class="mobile-buttons yellow" href="{{ route('member.logout') }}"><i
                                                    style="margin-right: 2px;"
                                                    class="d-inline-block  fa-power-off fa-solid pr-1"></i>
                                                লগ আউট </a></li>
                                    </ul>
                                </div>
                                <div class="tab-main-box">
                                    <form name="editForm" action="{{ route('member.updateprofile') }}" method="POST"
                                        enctype="multipart/form-data" data-parsley-validate="">
                                        @csrf

                                        @isset($basicInformation)
                                            <input type="hidden" name="basicinfo" value="{{ $basicInformation->id }}" />
                                            <input type="hidden" name="age" value="{{ $basicInformation->age }}">
                                        @endisset
                                        @isset($educationcareer)
                                            <input type="hidden" name="educationcareer" value="{{ $educationcareer->id }}" />
                                        @endisset
                                        @isset($educationalvalues)
                                            <input type="hidden" name="educationvalue" value="{{ $educationalvalues->id }}" />
                                        @endisset
                                        @isset($memberimage)
                                            <input type="hidden" name="memberimage" value="{{ $memberimage->id }}" />
                                        @endisset
                                        @isset($aboutmyself)
                                            <input type="hidden" name="aboutme" value="{{ $aboutmyself->id }}" />
                                        @endisset
                                        <input type="hidden" name="familylocation"
                                            value="{{ $familylocation ? $familylocation->id : '' }}" />

                                        <div class="register-form login-padding-ma" style="padding-bottom: 15px;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="page_divider">
                                                        <h3 class="control-label">জীবন বৃত্তান্ত</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row light-shadow-borbou">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="fullName">সম্পূর্ন নাম <span
                                                                style="color: red;">*</span></label>
                                                        <input id="fullName" value="{{ $memberInfo->fullName ?? '' }}"
                                                            name="fullName" type="text"
                                                            class="form-control @error('fullName') is-invalid @enderror my-input"
                                                            required disabled readonly />
                                                        @error('fullName')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>মোবাইল নাম্বার <span style="color: red;">*</span> </label>
                                                        <input value="{{ $memberInfo->phoneNumber }}" name="phoneNumber"
                                                            maxlength="11" type="text"
                                                            class="form-control @error('phoneNumber') is-invalid @enderror"
                                                            required disabled readonly />
                                                        @error('phoneNumber')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="father_name">বাবার নাম</label>

                                                        <input type="text"
                                                            class="my-select form-control @error('father_name') is-invalid @enderror"
                                                            value="{{ $familylocation->father_name ?? '' }}"
                                                            name="father_name" id="father_name" disabled />
                                                        @error('father_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="mother_name">মায়ের নাম </label>
                                                        <input type="text"
                                                            class="my-select form-control @error('mother_name') is-invalid @enderror"
                                                            value="{{ $familylocation->mother_name ?? '' }}"
                                                            name="mother_name" id="mother_name" disabled />
                                                        @error('mother_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>অন্য মোবাইল নাম্বার </label>
                                                        <input value="{{ $familylocation->alt_contact ?? '' }}"
                                                            onkeypress="return onlyNumbers(event);"
                                                            oninput="convertToEnglishNumbers(this)" name="alt_contact"
                                                            type="text" maxlength="11"
                                                            class="my-select form-control @error('alt_contact') is-invalid @enderror"
                                                            disabled />
                                                        @error('alt_contact')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                            </div>

                                            <div class="row atincrement educationcareer-value-inner">
                                                <div class="educationcareer-value-item col-sm-4">
                                                    <label>শিক্ষাগত যোগ্যতা <span style="color: red;">*</span></label>
                                                    <select required name="education_level"
                                                        class="my-select education_level form-select   @error('education_level') is-invalid @enderror"
                                                        id="education_level">
                                                        <option value="">নির্বাচন করুন</option>

                                                        @foreach ($edulevels as $edulevel)
                                                            <option value="{{ $edulevel->id }}">{{ $edulevel->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('education_level')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- col end -->
                                                {{--
                                                <div class="educationcareer-value-item col-sm-4">
                                                    <label>ডিগ্রীর নাম <span style="color: red;">*</span></label>
                                                    <select required name="degree_id"
                                                        class="my-select degree_id form-select   " id="degree_id">
                                                        <option value="">নির্বাচন করুন</option>

                                                        @foreach ($degrees as $degree)
                                                            <option value="{{ $degree->id }}">{{ $degree->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('degree_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- col end -->
                                                <div class="educationcareer-value-year col-sm-4">
                                                    <div class="form-group">
                                                        <label>অন্য কোন ডিগ্রীর নাম </label>
                                                        <input type="text" oninput="convertToBengaliNumbers(this)"
                                                            name="alt_degree" maxlength="100"
                                                            class="my-input form-control @error('alt_degree') is-invalid @enderror"
                                                            value="{{ $educationalvalues->alt_degree ?? '' }}" />
                                                        @error('alt_degree')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row light-shadow-borbou">
                                                --}}
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>পেশাগত যোগ্যতা <span style="color: red;">*</span> </label>
                                                        <select name="profession_id" id=""
                                                            class="my-select form-select select2  @error('profession_id') is-invalid @enderror"
                                                            required>
                                                            <option value="">নির্বাচন করুন </option>
                                                            @foreach ($professions as $profession)
                                                                <option value="{{ $profession->id }}">
                                                                    {{ $profession->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('profession_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>কর্মক্ষেত্র <span style="color: red;">*</span> </label>
                                                        <select name="working_id" id=""
                                                            class="my-select form-select @error('working_id') is-invalid @enderror  "
                                                            required>
                                                            <option value="">নির্বাচন করুন </option>
                                                            @foreach ($workings as $working)
                                                                <option value="{{ $working->id }}">{{ $working->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('working_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                {{--
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="profession_details">অন্য কোন পেশার নাম</label>
                                                        <input type="text"
                                                            value="{{ $educationcareer ? $educationcareer->profession_details : '' }}"
                                                            name="profession_details" type="text" maxlength="100"
                                                            class="my-input form-control @error('profession_details') is-invalid @enderror" />
                                                        @error('profession_details')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                --}}
                                            </div>
                                            <div class="shadow-padding-fixer-1 light-shadow-borbou grid-item-5">
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label for="gender">পুরুষ / মহিলা <span
                                                                style="color: red;">*</span> </label>
                                                        <select required name="gender" id="gender"
                                                            class="my-select form-select @error('gender') is-invalid @enderror  ">
                                                            <option value=""> নির্বাচন করুন</option>
                                                            <option value="1">পুরুষ</option>
                                                            <option value="2">মহিলা</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ form-group -->
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label>বৈবাহিক অবস্থা <span style="color: red;">*</span></label>
                                                        <select name="marital_status" id=""
                                                            class="my-select form-select @error('marital_status') is-invalid @enderror  "
                                                            required>
                                                            <option value="">নির্বাচন করুন </option>
                                                            @foreach ($maritalstatuses as $marital)
                                                                <option value="{{ $marital->id }}">{{ $marital->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('marital_status')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label>বাচ্চার সংখ্যা </label>
                                                        <input type="text"
                                                            value="{{ $basicInformation ? $basicInformation->children_no : '' }}"
                                                            class="my-input form-control @error('children_no') is-invalid @enderror"
                                                            oninput="convertToBengaliNumbers(this)" name="children_no"
                                                            id="" />
                                                        @error('children_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label>ধর্ম <span style="color: red;">*</span></label>
                                                        <select name="religion_id" id="religion_id"
                                                            class="my-select   form-select @error('religion_id') is-invalid @enderror"
                                                            required>
                                                            <option value="">নির্বাচন করুন </option>
                                                            @foreach ($religions as $religion)
                                                                <option value="{{ $religion->id }}">
                                                                    {{ $religion->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('religion_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label for="complexion">ত্বকের রং <span
                                                                style="color: red;">*</span> </label>
                                                        <select required name="complexion" id="complexion"
                                                            class="my-select form-select @error('complexion') is-invalid @enderror  ">
                                                            <option value=""> নির্বাচন করুন</option>
                                                            @foreach ($complexions as $complex)
                                                                <option value="{{ $complex->id }}">{{ $complex->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('complexion')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ form-group -->

                                            </div>
                                            <!-- ./ col -->
                                            <div class="shadow-padding-fixer-1 light-shadow-borbou grid-item-5">
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label>জন্ম তারিখ <span style="color: red;">*</span></label>
                                                        <select name="day" id=""
                                                            class="my-select   form-select @error('day') is-invalid @enderror"
                                                            required>
                                                            <option value="">জন্ম তারিখ</option>
                                                            @for ($i = 1; $i <= 31; $i++)
                                                                <option
                                                                    @if ($i < 10) value="0{{ $i }}" @else value="{{ $i }}" @endif
                                                                    value="{{ $i }}">
                                                                    {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        @error('day')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label>মাস <span style="color: red;">*</span></label>
                                                        <select name="month" id=""
                                                            class="my-select form-select   @error('month') is-invalid @enderror"
                                                            required>
                                                            <option value="">মাস</option>
                                                            @foreach ($monthnames as $month)
                                                                <option
                                                                    @if ($month->id < 10) value="0{{ $month->id }}" @else value="{{ $month->id }}" @endif>
                                                                    {{ $month->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('day')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="grid-item">
                                                    <div class="form-group">
                                                        <label>বছর <span style="color: red;">*</span> </label>
                                                        <select name="year" id=""
                                                            class="my-select  select2 form-select @error('year') is-invalid @enderror"
                                                            required>
                                                            <option value="">বছর</option>
                                                            @php
                                                                $currentYear = date('Y');
                                                                $looplimit = $currentYear - 18;
                                                            @endphp @for ($i = $looplimit; $i >= 1940; $i--)
                                                                <option value="{{ $i }}">
                                                                    {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        @error('day')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="grid-item">
                                                    <div class="form-group position-relative">
                                                        <label for="height_feet">উচ্চতা <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text"
                                                            value="{{ $basicInformation ? $basicInformation->feet : '' }}"
                                                            oninput="convertToBengaliNumbers(this)" required
                                                            name="feet" maxlength="1"
                                                            class="my-input form-control @error('feet') is-invalid @enderror"
                                                            id="height_feet" />
                                                        <span class="absolute-span">ফুট</span>
                                                        @error('feet')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ form-group -->
                                                <div class="grid-item">
                                                    <div class="form-group position-relative">
                                                        <label for="height_inch"> উচ্চতা <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text"
                                                            value="{{ $basicInformation ? $basicInformation->inch : '' }}"
                                                            oninput="convertToBengaliNumbers(this)" required
                                                            name="inch" maxlength="2"
                                                            class="my-input form-control @error('feet') is-invalid @enderror"
                                                            id="height_inch" />
                                                        <span class="absolute-span">ইঞ্চি</span>

                                                        @error('inch')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./ col -->


                                            <div class="row light-shadow-borbou">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>জাতীয়তা <span style="color: red;">*</span> </label>
                                                        <select name="country_id" id=""
                                                            class="my-select form-select @error('country_id') is-invalid @enderror  "
                                                            required>
                                                            <option value="">নির্বাচন করুন</option>
                                                            @foreach ($nationalities as $nation)
                                                                <option value="{{ $nation->id }}"
                                                                    @if ($nation->id == 1) selected @endif>
                                                                    {{ $nation->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="nationality_id">নাগরিকত্ব <span
                                                                style="color: red;">*</span> </label>
                                                        <select name="nationality_id" id="nationality_id"
                                                            class="my-select form-select @error('nationality_id') is-invalid @enderror  "
                                                            required>
                                                            <option value="">নির্বাচন করুন</option>
                                                            @foreach ($nationalities as $nation)
                                                                <option value="{{ $nation->id }}"
                                                                    @if ($nation->id == 1) selected @endif>
                                                                    {{ $nation->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('nationality_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="residency_id">আবাস্থল <span
                                                                style="color: red;">*</span> </label>
                                                        <select name="residency_id" id="residency_id"
                                                            class="my-select form-select @error('residency_id') is-invalid @enderror  "
                                                            required>
                                                            <option value="">নির্বাচন করুন</option>
                                                            @foreach ($nationalities as $nation)
                                                                <option value="{{ $nation->id }}"
                                                                    @if ($nation->id == 1) selected @endif>
                                                                    {{ $nation->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('residency_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                            </div>

                                            <div class="row light-shadow-borbou">
                                                <div class="col-sm-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="">স্থায়ী ঠিকানা </label>
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="division_id">বিভাগ <span
                                                                style="color: red;">*</span></label>
                                                        <select required name="division_id" id="division_id"
                                                            class="my-select form-select @error('division_id') is-invalid @enderror   division_id">
                                                            <option value="">বিভাগ </option>
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}">
                                                                    {{ $location->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('division_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="district_id">জেলা <span
                                                                style="color: red;">*</span></label>
                                                        <select required name="district_id"
                                                            class="my-select form-select @error('district_id') is-invalid @enderror   district_id"
                                                            id="district_id">
                                                            @foreach ($permanent_dists as $permanent_d)
                                                                <option value="{{ $permanent_d->id }}">
                                                                    {{ $permanent_d->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('district_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="upazila_id">উপজেলা <span
                                                                style="color: red;">*</span></label>
                                                        <select required name="upazila_id"
                                                            class="my-select form-select @error('upazila_id') is-invalid @enderror   upazila_id"
                                                            id="upazila_id">
                                                            @foreach ($permanent_upazillas as $permanent_upa)
                                                                <option value="{{ $permanent_upa->id }}">
                                                                    {{ $permanent_upa->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('upazila_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="permanent_address">গ্রাম / এরিয়া <span
                                                                style="color: red;">*</span> </label>
                                                        <input type="text"
                                                            class="form-control @error('permanent_address') is-invalid @enderror my-input"
                                                            value="{{ $familylocation ? $familylocation->permanent_address : '' }}"
                                                            required name="permanent_address" id="permanent_address" />
                                                        @error('permanent_address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">বর্তমান ঠিকানা </label>
                                                        <label for="sameAsPermanent" class="same-as-label ">একই <input
                                                                type="checkbox" name="same_address"
                                                                class="same-as-permanent" id="sameAsPermanent"
                                                                value="1" /></label>
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3 same-as-hide">
                                                    <div class="form-group">
                                                        <label for="">বিভাগ <span
                                                                style="color: red;">*</span></label>
                                                        <select required name="present_division" id="present_division"
                                                            class="my-select form-select @error('present_division') is-invalid @enderror   division_id">
                                                            <option value="">বিভাগ</option>
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}">
                                                                    {{ $location->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('present_division')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3 same-as-hide">
                                                    <div class="form-group">
                                                        <label for="">জেলা <span
                                                                style="color: red;">*</span></label>
                                                        <select required name="present_district"
                                                            class="my-select form-select @error('present_district') is-invalid @enderror   district_id"
                                                            id="present_district">
                                                            @foreach ($present_dists as $present_d)
                                                                <option value="{{ $present_d->id }}">
                                                                    {{ $present_d->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('present_district')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3 same-as-hide">
                                                    <div class="form-group">
                                                        <label for="">উপজেলা <span
                                                                style="color: red;">*</span></label>
                                                        <select required name="present_upazila"
                                                            class="my-select form-select @error('present_upazila') is-invalid @enderror   upazila_id"
                                                            id="present_upazila">
                                                            @foreach ($present_upazillas as $present_upa)
                                                                <option value="{{ $present_upa->id }}">
                                                                    {{ $present_upa->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('present_upazila')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-3 same-as-hide">
                                                    <div class="form-group">
                                                        <label for="present_address">গ্রাম / এরিয়া <span
                                                                style="color: red;">*</span> </label>
                                                        <input type="text"
                                                            class="form-control @error('present_address') is-invalid @enderror my-input"
                                                            required name="present_address" id="present_address"
                                                            value="{{ $familylocation ? $familylocation->present_address : '' }}" />
                                                        @error('present_address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                            </div>
                                            <div class="row light-shadow-borbou">
                                                <div class="col-sm-12 mb-2">
                                                    <p class="max-image-text">আপনার তিনটি ছবি আপলোড করুন</p>
                                                    <div class="register-image-wrapper">
                                                        <div class="addphoto-flex" id="editPhotos">

                                                            <div class="image-div">

                                                                <img id="preview_one"
                                                                    src="{{ asset($memberimage->image_one) }}" />

                                                                <label for="" class="upload-btn member-image">
                                                                    পরিবর্তন
                                                                    <input type="file" name="image_one" id="image_one"
                                                                        class="file-input @error('image_one') is-invalid @enderror"
                                                                         />
                                                                </label>
                                                                @error('image_one')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="image-div">
                                                                <img id="preview_two"
                                                                    src="{{ asset($memberimage->image_two) }}" />
                                                                <label for="" class="upload-btn member-image">
                                                                    পরিবর্তন
                                                                    <input type="file" name="image_two" id="image_two"
                                                                        class="file-input @error('image_two') is-invalid @enderror"
                                                                         />
                                                                </label>

                                                                @error('image_two')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="image-div">
                                                                <img id="preview_three"
                                                                    src="{{ asset($memberimage->image_three) }}" />
                                                                <label for="" class="upload-btn member-image">
                                                                    পরিবর্তন
                                                                    <input type="file" name="image_three"
                                                                        id="image_three"
                                                                        class="file-input @error('image_three') is-invalid @enderror"
                                                                         />
                                                                </label>
                                                                @error('image_three')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="description">
                                                            বিস্তারিত বর্ণনা
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <textarea name="description"
                                                            class="my-input  register-textarea form-control @error('description') is-invalid @enderror" id=""
                                                            cols="30" maxlength="500" rows="4" required>{{ $aboutmyself ? $aboutmyself->description : '' }}</textarea>
                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ./ col -->
                                            </div>
                                            <div class="row justify-content-center">
                                                <button class="my-input" type="submit">সাবমিট</button>
                                            </div>
                                        </div>
                                    </form>

                                    <!--<div class="make-premium-wrapper" >-->
                                    <!-- premium member -->
                                    <!--       <div class="card">-->
                                    <!--           <div class="card-body">-->
                                    <!--               <div class="container-fluid">-->
                                    <!--                   <div class="row mx-auto">-->
                                    <!--                       <div class="package-box">-->
                                    <!--<p class="register_regard">ধন্যবাদ </p>-->
                                    <!--                           <p class="member-note">আপনি ইচ্ছে করলে প্রথম পাতায় আপনার জীবন বৃত্তান্ত প্রদর্শন করতে পারবেন, যা আপনাকে দ্রুত সময়ে বর বউ খুঁজে পেতে সহযোগিতা করবে।</p>-->
                                    <!--                           <div class="package_title">-->
                                    <!--                               <h3>প্যাকেজ সমূহ </h3>-->
                                    <!--                           </div>-->
                                    <!--                           <table class="table table-bordered text-center">-->
                                    <!--                               <tbody>-->
                                    <!--                                   <tr>-->
                                    <!--                                       <td>১ মাসের জন্য ১০০ টাকা  <div class="form-group">-->
                                    <!--                                       <form method="post" action="{{ route('member.make_premium', ['plan' => 1]) }}"> @csrf</div></td>-->
                                    <!--                                       <td><button class="btn btn-warning">পেমেন্ট করুন </button></form></td>-->
                                    <!--                                   </tr>-->
                                    <!--                                   <tr>-->
                                    <!--                                       <td>৩ মাসের জন্য ২৫০ টাকা  <form method="post" action="{{ route('member.make_premium', ['plan' => 2]) }}"> @csrf-->
                                    <!--                                       </div></td>-->
                                    <!--                                       <td><button class="btn btn-warning">পেমেন্ট করুন </button></form></td>-->
                                    <!--                                   </tr>-->
                                    <!--                                   <tr>-->
                                    <!--                                       <td>৬ মাসের জন্য ৫০০ টাকা  <form method="post" action="{{ route('member.make_premium', ['plan' => 3]) }}"> @csrf-->
                                    <!--                                       </div></td>-->
                                    <!--                                       <td><button class="btn btn-warning">পেমেন্ট করুন </button></form></td>-->
                                    <!--                                   </tr>-->
                                    <!--                               </tbody>-->
                                    <!--                           </table>-->
                                    <!--                       </div>-->
                                    <!--                   </div>-->

                                    <!--               </div>-->
                                    <!--           </div>-->
                                </div>
                            </div>
                            <!--Photo end-->

                        </div>
                    </div>
                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            </div>
        </div>
        </div>
        </div>
    </section>
    @php
        $user = Auth::guard('member')->user();
    @endphp

    @if ($user && $user->publish == 0)
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(() => $('#staticBackdrop').modal('show'));
        </script>
    @endif


    @include('frontEnd.layouts.paymentmodal')

@endsection
@section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
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
    </script>
    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $(previewId).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_one").change(function() {
            previewImage(this, "#preview_one");
        });
        $("#image_two").change(function() {
            previewImage(this, "#preview_two");
        });
        $("#image_three").change(function() {
            previewImage(this, "#preview_three");
        });
    </script>
    <script>
        $(document).ready(function() {
            // When the button is clicked, check the checkbox and get its checked status
            $(".same-as-label").click(function() {
                // Get the checked status of the checkbox
                var isChecked = $("#sameAsPermanent").prop("checked");

                // Display the result in the console
                console.log("Checkbox is checked: " + isChecked);

                // You can use the isChecked variable in your condition
                if (isChecked) {
                    // Do something if the checkbox is checked
                    $(".same-as-hide").slideUp();
                    $(".same-as-label").addClass("active");
                    // remove the required attribute
                    $("#present_district").prop("required", false);
                    $("#present_division").prop("required", false);
                    $("#present_upazila").prop("required", false);
                    $("#present_address").prop("required", false);
                } else {
                    // Do something if the checkbox is not checked
                    $(".same-as-hide").slideDown();
                    $(".same-as-label").removeClass("active");
                    // add the required attribute
                    $("#present_district").prop("required", false);
                    $("#present_division").prop("required", false);
                    $("#present_upazila").prop("required", false);
                    $("#present_address").prop("required", false);
                }
            });
        });
    </script>
    <script>
        function convertToBengaliNumbers(input) {
            const englishNumbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
            const bengaliNumbers = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];

            let inputValue = input.value;
            for (let i = 0; i < 10; i++) {
                inputValue = inputValue.replace(new RegExp(englishNumbers[i], "g"), bengaliNumbers[i]);
            }

            input.value = inputValue;
        }

        function convertToEnglishNumbers(input) {
            const englishNumbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
            const bengaliNumbers = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];

            let inputValue = input.value;
            for (let i = 0; i < 10; i++) {
                inputValue = inputValue.replace(new RegExp(bengaliNumbers[i], "g"), englishNumbers[i]);
            }

            input.value = inputValue;
        }

        function onlyNumbers(event) {
            const key = event.key;
            const allowedKeys = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "০", "১", "২", "৩", "৪", "৫", "৬", "৭",
                "৮", "৯"
            ];
            return allowedKeys.includes(key) || key === "Backspace" || key === "Delete";
        }
    </script>

    @if ($basicInformation)
        <script type="text/javascript">
            @php
                $day = date('d', strtotime($basicInformation->dob));
                $month = date('m', strtotime($basicInformation->dob));
                $year = date('Y', strtotime($basicInformation->dob));
            @endphp

            document.forms['editForm'].elements['day'].value = "{{ $day }}";
            document.forms['editForm'].elements['month'].value = "{{ $month }}";
            document.forms['editForm'].elements['year'].value = "{{ $year }}";
            document.forms['editForm'].elements['gender'].value = "{{ $basicInformation->gender }}";
            document.forms['editForm'].elements['country_id'].value = "{{ $basicInformation->country_id }}";
            document.forms['editForm'].elements['nationality_id'].value = "{{ $basicInformation->nationality_id }}";
            document.forms['editForm'].elements['residency_id'].value = "{{ $basicInformation->residency_id }}";
            document.forms['editForm'].elements['religion_id'].value = "{{ $basicInformation->religion_id }}";
            document.forms['editForm'].elements['marital_status'].value = "{{ $basicInformation->marital_status }}";
            document.forms['editForm'].elements['division_id'].value =
                "{{ $familylocation ? $familylocation->division_id : '' }}";
            document.forms['editForm'].elements['district_id'].value =
                "{{ $familylocation ? $familylocation->district_id : '' }}";
            document.forms['editForm'].elements['upazila_id'].value =
                "{{ $familylocation ? $familylocation->upazila_id : '' }}";
            document.forms['editForm'].elements['present_division'].value =
                "{{ $familylocation ? $familylocation->present_division : '' }}";
            document.forms['editForm'].elements['present_district'].value =
                "{{ $familylocation ? $familylocation->present_district : '' }}";
            document.forms['editForm'].elements['present_upazila'].value =
                "{{ $familylocation ? $familylocation->present_upazila : '' }}";
        </script>
    @else
        <script type="text/javascript">
            document.forms["editForm"].elements["country_id"].value = "14";
            document.forms["editForm"].elements["nationality_id"].value = "14";
        </script>
    @endif
    @if ($basicInformation)
        <script type="text/javascript">
            document.forms["editForm"].elements["complexion"].value = "{{ $basicInformation->complexion }}";
        </script>
    @endif
    @if ($familylocation)
        <script type="text/javascript">
            document.forms["editForm"].elements["mother_profession"].value = "{{ $familylocation->mother_profession }}";
            document.forms["editForm"].elements["father_profession"].value = "{{ $familylocation->father_profession }}";
        </script>
    @endif
    @if ($educationcareer)
        <script type="text/javascript">
            document.forms["editForm"].elements["working_id"].value = "{{ $educationcareer->working_id }}";
            document.forms["editForm"].elements["profession_id"].value = "{{ $educationcareer->profession_id }}";
        </script>
    @endif
    @if ($educationalvalues)
        <script type="text/javascript">
            // document.forms["editForm"].elements["degree_id"].value = "{{ $educationalvalues->degree_id }}";
            document.forms["editForm"].elements["education_level"].value = "{{ $educationalvalues->education_id }}";
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Get references to the input and select elements with the specified class
            var inputElement = $(".my-input");
            var selectElement = $(".my-select");
            var myImage = $(".member-image");

            // Disable the elements on page load using jQuery
            inputElement.prop("disabled", true);
            selectElement.prop("disabled", true);
            myImage.hide();
            $(".same-as-label").addClass("pointer-events");

            // Get references to the enable and disable buttons
            var enableButton = $("#enableBtn");
            // Add click event listeners to the enable and disable buttons using jQuery
            enableButton.click(function() {
                inputElement.prop("disabled", false);
                selectElement.prop("disabled", false);
                myImage.show();
                $(".same-as-label").removeClass("pointer-events");

            });


        });
    </script>
    <script>
        // const textarea = document.querySelector('textarea');

        // // Add input event listener to adjust height dynamically
        // textarea.addEventListener('input', function () {
        //     this.style.height = 'auto'; // Reset height to auto to recalculate
        //     this.style.height = this.scrollHeight + 'px'; // Set height to scrollHeight
        // });
    </script>

    <script>
        // // Function to adjust the height of a textarea
        // function adjustHeight(textarea) {
        //     textarea.style.height = 'auto'; // Reset height to auto to recalculate
        //     textarea.style.height = (textarea.scrollHeight + 3) + 'px';
        // }

        // // Select the textarea
        // const textarea = document.querySelector('textarea');

        // // Adjust height on page load
        // window.addEventListener('DOMContentLoaded', () => {
        //     adjustHeight(textarea);
        // });

        // // Adjust height dynamically on input
        // textarea.addEventListener('input', function () {
        //     adjustHeight(this);
        // });
    </script>

@endsection
