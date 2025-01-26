@extends('frontEnd.layouts.master')
@section('title', '')

<style>
    .toggle-btn {
        position: absolute;
        top: 50%;
        right: 10px;
        cursor: pointer;
    }
</style>

@section('content')
    @include('frontEnd.layouts.navigation')
    <div id="content" class="full-sections regiser-padding">
        <div class="container">
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <form name="myForm" action="{{ route('member_registermissing') }}" method="POST"
                            enctype="multipart/form-data" data-parsley-validate="">
                            @csrf
                            <div class="register-form login-padding-ma">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="page_divider">
                                            <h3 class="control-label">জীবন বৃত্তান্ত</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row light-shadow-borbou">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="id">Missing ID<span style="color: red;">*</span></label>
                                            <input id="id" value="{{ old('id') }}" name="id"
                                                type="text" class="form-control @error('id') is-invalid @enderror"
                                                required />
                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="fullName">সম্পূর্ন নাম <span style="color: red;">*</span></label>
                                            <input id="fullName" value="{{ old('fullName') }}" name="fullName"
                                                type="text" class="form-control @error('fullName') is-invalid @enderror"
                                                required />
                                            @error('fullName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>মোবাইল নাম্বার <span style="color: red;">*</span> </label>
                                            <input value="{{ old('phoneNumber') }}" oninput="onlyNumbersAndConvert(this)" name="phoneNumber" type="text"
                                                class="form-control @error('phoneNumber') is-invalid @enderror" maxlength="11" required />
                                            @error('phoneNumber')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                    <div class="col-sm-4">
                                        <div class="form-group position-relative">
                                            <label>পাসওয়ার্ড <span style="color: red;">*</span></label>
                                            <input type="password" value="{{ old('password') }}" id="passwordInput"
                                                name="password" type="text"
                                                class="form-control @error('password') is-invalid @enderror" required />
                                            <span class="toggle-btn" id="togglePassword">&#128065;</span>
                                            @error('password')
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
                                                class="form-control @error('father_name') is-invalid @enderror"
                                                name="father_name" id="father_name" />
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
                                                class="form-control @error('mother_name') is-invalid @enderror"
                                                name="mother_name" id="mother_name" />
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
                                            <input value="{{ old('alt_contact') }}" 
                                                 oninput="onlyNumbersAndConvert(this)"  maxlength="11" name="alt_contact" type="text"
                                                class="form-control @error('alt_contact') is-invalid @enderror" />
                                            @error('alt_contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                    <div class="col-sm-12">
                                        <div class="page_note">
                                            <p style="color: red;">বিশেষ দ্রষ্টব্যঃ আপনি অনাকাঙ্খিত কল এড়াতে অভিভাবকের
                                                মোবাইল নাম্বার ব্যবহার করুন।</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./ col -->
                                <!-- ./ col -->
                                <div class="row atincrement educationcareer-value-inner">
                                    <div class="educationcareer-value-item col-sm-4">
                                        <label>শিক্ষাগত যোগ্যতা <span style="color: red;">*</span></label>
                                        <select name="education_level" required
                                            class="education_level form-select select2 @error('education_level') is-invalid @enderror"
                                            id="education_level">
                                            <option value="">নির্বাচন করুন</option>

                                            @foreach ($edulevels as $edulevel)
                                                <option value="{{ $edulevel->id }}">{{ $edulevel->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('education_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- col end -->
                                    <div class="educationcareer-value-item col-sm-4">
                                        <label>ডিগ্রীর নাম <span style="color: red;">*</span></label>
                                        <select name="degree_id" required class="degree_id form-select select2"
                                            id="degree_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @foreach ($edulevels as $edulevel)
                                                <option value="{{ $edulevel->id }}">{{ $edulevel->title }}</option>
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
                                            <input type="text" name="alt_degree"
                                                class="form-control @error('alt_degree') is-invalid @enderror"
                                                value="{{ old('alt_degree') }}" maxlength="100" />
                                            @error('alt_degree')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row light-shadow-borbou">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>পেশার নাম <span style="color: red;">*</span> </label>
                                            <select name="profession_id" id=""
                                                class="form-select select2 @error('profession_id') is-invalid @enderror"
                                                required>
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($professions as $profession)
                                                    <option value="{{ $profession->id }}">{{ $profession->title }}
                                                    </option>
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
                                                class="form-select @error('working_id') is-invalid @enderror select2"
                                                required>
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($workings as $working)
                                                    <option value="{{ $working->id }}">{{ $working->title }}</option>
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="profession_details">অন্য কোন পেশার নাম</label>
                                            <input type="text" value="{{ old('profession_details') }}"
                                                name="profession_details" maxlength="100" type="text"
                                                class="form-control @error('profession_details') is-invalid @enderror" />
                                            @error('profession_details')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- ./ col -->
                                <div class="shadow-padding-fixer-1 light-shadow-borbou grid-item-5">
                                    <div class="grid-item">
                                        <div class="form-group">
                                            <label for="gender">পুরুষ / মহিলা <span style="color: red;">*</span>
                                            </label>
                                            <select required name="gender" id="gender"
                                                class="form-select @error('gender') is-invalid @enderror select2">
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
                                    <div class="grid-item">
                                        <div class="form-group">
                                            <label>বৈবাহিক অবস্থা <span style="color: red;">*</span></label>
                                            <select name="marital_status" id=""
                                                class="form-select @error('marital_status') is-invalid @enderror select2"
                                                required>
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($maritalstatuses as $marital)
                                                    <option value="{{ $marital->id }}">{{ $marital->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('marital_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror @error('day')
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
                                                class="form-control @error('children_no') is-invalid @enderror"
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
                                                class="select2 form-select @error('religion_id') is-invalid @enderror"
                                                required>
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->id }}">{{ $religion->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('religion_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="grid-item">
                                        <div class="form-group">
                                            <label for="complexion">ত্বকের রং <span style="color: red;">*</span> </label>
                                            <select required name="complexion" id="complexion"
                                                class="form-select @error('complexion') is-invalid @enderror select2">
                                                <option value=""> নির্বাচন করুন</option>
                                                @foreach ($complexions as $complex)
                                                    <option value="{{ $complex->id }}">{{ $complex->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('complexion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <!-- ./ col -->
                                <div class="shadow-padding-fixer-1 light-shadow-borbou grid-item-5">


                                    <div class="grid-item">
                                        <div class="form-group">
                                            <label>জন্ম তারিখ <span style="color: red;">*</span></label>
                                            <select name="day" id=""
                                                class="select2 form-select @error('day') is-invalid @enderror" required>
                                                <option value="">জন্ম তারিখ</option>
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option
                                                        @if ($i < 10) value="0{{ $i }}" @else value="{{ $i }}" @endif
                                                        value="{{ $i }}">
                                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }}</option>
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
                                                class="form-select select2 @error('month') is-invalid @enderror" required>
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
                                                class="select2 form-select @error('year') is-invalid @enderror" required>
                                                <option value="">বছর</option>
                                                @php
                                                    $currentYear = date('Y');
                                                    $looplimit = $currentYear - 18;
                                                @endphp @for ($i = $looplimit; $i >= 1920; $i--)
                                                    <option value="{{ $i }}">
                                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($i) }}</option>
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
                                            <label for="height_feet">উচ্চতা <span style="color: red;">*</span></label>
                                            <input type="text" maxlength="1" oninput="onlyBNumbersAndConvert(this)"
                                                required name="feet"
                                                class="form-control @error('feet') is-invalid @enderror"
                                                id="height_feet" />
                                            <span class="absolute-span">ফুট</span>
                                            @error('day')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="grid-item">
                                        <div class="form-group position-relative">
                                            <label for="height_inch"> উচ্চতা <span style="color: red;">*</span></label>
                                            <input type="text" maxlength="2" oninput="onlyBNumbersAndConvert(this)"
                                                required name="inch"
                                                class="form-control @error('feet') is-invalid @enderror"
                                                id="height_inch" />
                                            <span class="absolute-span">ইঞ্চি</span>
                                            @error('day')
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
                                                class="form-select @error('country_id') is-invalid @enderror select2"
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
                                            <label for="nationality_id">নাগরিকত্ব <span style="color: red;">*</span>
                                            </label>
                                            <select name="nationality_id" id="nationality_id"
                                                class="form-select @error('nationality_id') is-invalid @enderror select2"
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
                                            <label for="residency_id">আবাস্থল <span style="color: red;">*</span> </label>
                                            <select name="residency_id" id="residency_id"
                                                class="form-select @error('residency_id') is-invalid @enderror select2"
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
                                </div>

                                <div class="row light-shadow-borbou">
                                    <!-- ./ col -->
                                    <div class="col-sm-12 mt-2">
                                        <div class="form-group">
                                            <label for="">স্থায়ী ঠিকানা </label>
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="division_id">বিভাগ <span style="color: red;">*</span></label>
                                            <select required name="division_id" id="division_id"
                                                class="form-select @error('division_id') is-invalid @enderror select2 division_id">
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->title }}</option>
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
                                            <label for="district_id">জেলা <span style="color: red;">*</span></label>
                                            <select required name="district_id"
                                                class="form-select @error('district_id') is-invalid @enderror select2 district_id"
                                                id="district_id"></select>
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
                                            <label for="upazila_id">উপজেলা <span style="color: red;">*</span></label>
                                            <select required name="upazila_id"
                                                class="form-select @error('upazila_id') is-invalid @enderror select2 upazila_id"
                                                id="upazila_id"></select>
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
                                                class="form-control @error('permanent_address') is-invalid @enderror"
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
                                            <label for="sameAsPermanent" class="same-as-label">একই <input type="checkbox"
                                                    name="same_address" class="same-as-permanent" id="sameAsPermanent"
                                                    value="1" /></label>
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                    <div class="col-sm-3 same-as-hide">
                                        <div class="form-group">
                                            <label for="">বিভাগ <span style="color: red;">*</span></label>
                                            <select required name="present_division" id="present_division"
                                                class="form-select @error('present_division') is-invalid @enderror select2 division_id">
                                                <option value="">নির্বাচন করুন </option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->title }}</option>
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
                                            <label for="">জেলা <span style="color: red;">*</span></label>
                                            <select required name="present_district"
                                                class="form-select @error('present_district') is-invalid @enderror select2 district_id"
                                                id="present_district"></select>
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
                                            <label for="">উপজেলা <span style="color: red;">*</span></label>
                                            <select required name="present_upazila"
                                                class="form-select @error('present_upazila') is-invalid @enderror select2 upazila_id"
                                                id="present_upazila"></select>
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
                                            <label for="present_address">গ্রাম / এরিয়া <span style="color: red;">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('present_address') is-invalid @enderror"
                                                required name="present_address" id="present_address" />
                                            @error('present_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row light-shadow-borbou">
                                    <!-- ./ col -->
                                    <div class="col-sm-12">
                                        <p class="max-image-text">আপনার তিনটি ছবি আপলোড করুন</p>
                                        <div class="register-image-wrapper">
                                            <div class="addphoto-flex">
                                                <input type="file" name="image_one" id="image_one"
                                                    data-plugins="dropify"
                                                    class="dropify @error('image_one') is-invalid @enderror" required />
                                                @error('image_one')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <input type="file" name="image_two" id="image_two"
                                                    data-plugins="dropify"
                                                    class="dropify @error('image_two') is-invalid @enderror" required />
                                                @error('image_two')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <input type="file" name="image_three" id="image_three"
                                                    data-plugins="dropify"
                                                    class="dropify @error('image_three') is-invalid @enderror" required />
                                                @error('image_three')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                </div>

                                <div class="row light-shadow-borbou">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description">
                                                বিস্তারিত বর্ণনা
                                                <span style="color: red;">*</span>
                                            </label>
                                            <textarea name="description" class="register-textarea form-control @error('description') is-invalid @enderror"
                                                id="" cols="30" maxlength="300" rows="6" required></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- ./ col -->
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="cofirm-checkbox-wrapper">
                                            <!--<label class="switch">-->
                                            <!--    <input type="checkbox" id="myCheckbox" required>-->
                                            <!--    <span class="slider round red"></span>-->
                                            <!--</label>-->
                                            <span>
                                                আমি <a href="https://borbou.com.bd/page/conditions">শর্তাবলী</a> ও <a
                                                    href="https://borbou.com.bd/page/privacy-policy">গোপনীয়তা নীতি</a>
                                                মানতে রাজি।
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <!--<button type="submit" id="registerSubmit" disabled>সাবমিট</button>-->
                                    <button type="submit">সাবমিট</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade payup-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <button style="opacity: 1" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 15px 10px 10px;">
                    <div class="modal-body-wrapper">

                        <div class="modal-logo">
                            <img src="{{ asset($generalsetting->white_logo) }}" alt="">
                        </div>
                        <div class="modal-description">
                            <p>রেজিস্ট্রেশন ফি মাত্র ৫০০ টাকা</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button class="btn submit-secondary" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-top: 0; margin-bottom: 0">পেমেন্ট করুন</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <script>
        $(document).ready(function() {
            $('#staticBackdrop').modal('show');
        });
    </script>

    <script>
        $(document).ready(function() {

            $(".same-as-label").click(function() {

                var isChecked = $("#sameAsPermanent").prop("checked");


                console.log("Checkbox is checked: " + isChecked);


                if (isChecked) {

                    $(".same-as-hide").slideUp();
                    $(".same-as-label").addClass("active");

                    $("#present_district").prop("required", false);
                    $("#present_division").prop("required", false);
                    $("#present_upazila").prop("required", false);
                    $("#present_address").prop("required", false);
                } else {

                    $(".same-as-hide").slideDown();
                    $(".same-as-label").removeClass("active");

                    $("#present_district").prop("required", false);
                    $("#present_division").prop("required", false);
                    $("#present_upazila").prop("required", false);
                    $("#present_address").prop("required", false);
                }
            });



            $("#myCheckbox").on("change", function() {
                if ($(this).is(":checked")) {

                    $("#registerSubmit").prop("disabled", false);
                } else {

                    $("#registerSubmit").prop("disabled", true);
                }

            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {

                var passwordField = $('#passwordInput');
                var fieldType = passwordField.attr('type');

                if (fieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $('#togglePassword').html('&#128064;');
                } else {
                    passwordField.attr('type', 'password');
                    $('#togglePassword').html('&#128065;');
                }
            });
        });
    </script>
    <script>
    function onlyNumbersAndConvert(input) {
        // Extract the value from the input
        let value = input.value;
        
        // Remove any non-numeric characters
         value = value.replace(/[^০-৯0-9]/g, '');
    
        // Optionally, convert the numbers to English numerals if needed
        value = convertToEnglishNumbersb(value);
    
        // Update the input value
        input.value = value;
    }
    
    // Example of a conversion function (if needed)
    function convertToEnglishNumbersb(value) {
        // Assuming the input might have Bengali or other numerals,
        // this function would convert them to English numerals
        const bengaliToEnglishMap = {
            '০': '0', '১': '1', '২': '2', '৩': '3', '৪': '4',
            '৫': '5', '৬': '6', '৭': '7', '৮': '8', '৯': '9'
        };
        return value.replace(/[০-৯]/g, function(match) {
            return bengaliToEnglishMap[match];
        });
    }
    function onlyBNumbersAndConvert(input) {
        // Extract the value from the input
        let value = input.value;
        
        // Remove any non-numeric characters
         value = value.replace(/[^০-৯0-9]/g, '');
    
        // Optionally, convert the numbers to English numerals if needed
        value = convertToBengaliNumbersb(value);
    
        // Update the input value
        input.value = value;
    }
    function convertToBengaliNumbersb(value) {
        // Map English numerals to Bengali numerals
        const englishToBengaliMap = {
            '0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪',
            '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'
        };
    
        // Replace English numerals with their Bengali counterparts
        return value.replace(/[0-9]/g, function(match) {
            return englishToBengaliMap[match];
        });
    }

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
    <script type="text/javascript">
        document.forms["myForm"].elements["religion_id"].value = 1;
    </script>
@endsection
