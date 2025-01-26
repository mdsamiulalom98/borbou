<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/bootstrap.min.css" />
    <title>{{ $member->fullName }}</title>
    <style>
        body {
            font-family: 'nikosh', sans-serif !important;
        }

        td {
            line-height: 1.8;
            font-size: 18px;
            font-weight: 500;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="cv-inner">
        <div class="border-style-1">
            <div class="border-style-2">
                <div class="bio-heading" style="text-align:center">
                    <h1
                        style="font-family: 'nikosh', sans-serif;border-bottom:5px solid #FF0000;margin-bottom:3px;padding-bottom:3px;display:inline-block !important;font-size:35px;font-weight: normal;width:150px; margin:0 auto; color: #002A3A;">
                        জীবন বৃত্তান্ত </h1>
                </div>

                <div class="basic-info-image" style="width:100%;overflow:hidden;margin:25px 0">
                    @if ($pdf_image)
                        <div class="member-image"
                            style="width:200px;height: 200px;float: left;float:left;margin: 0px 25px;border-radius:5px !importantus: 5px;position: relative;overflow: hidden;border: 5px solid #ffcc00;">
                            <img src="{{ asset($pdf_image->image_one) }}"
                                style="width: 100%;height: 100%;object-fit: contain" alt="">
                        </div>
                        <div class="member-image"
                            style="width:200px;height: 200px;float: left;float:left;margin: 0px 25px;border-radius:5px !importantus: 5px;position: relative;overflow: hidden;border: 5px solid #ffcc00;">
                            <img src="{{ asset($pdf_image->image_two) }}"
                                style="width: 100%;height: 100%;object-fit: contain" alt="">
                        </div>
                        <div class="member-image"
                            style="width:200px;height: 200px;float: left;float:left;margin: 0px 25px;border-radius:5px !importantus: 5px;position: relative;overflow: hidden;border: 5px solid #ffcc00;">
                            <img src="{{ asset($pdf_image->image_three) }}"
                                style="width: 100%;height: 100%;object-fit: contain" alt="">
                        </div>
                    @endif
                </div>

                <!-- bio heading end -->
                <div class="about-myself" style="overflow:hidden;margin-top:0px">
                    <div class="data-heading"
                        style="background:#ffcc00;padding:10px 15px;margin:15px 0;border-radius:5px !important">
                        <h3 style="font-size:18px;font-weight: normal;">বিস্তারিত বর্ণনা</h3>
                    </div>
                    <div class="about-myself-left" style="width:100%;float:left">
                        <table style="width:100%">
                            <tbody>
                                <tr>
                                    <td style="width:100%; height: 100px;">
                                        <p style="font-size: 18px;font-weight:500">
                                            {{ $aboutmyself->description }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- bio heading end -->
                <div class="basic-info" style="overflow:hidden;margin-top:0px;margin-bottom: 50px;">
                    <div class="data-heading"
                        style="background:#ffcc00;padding:10px 15px;margin:15px 0;border-radius:5px !important">
                        <h3 style="font-size:18px;font-weight: normal;">ব্যক্তিগত তথ্য </h3>
                    </div>
                    <div class="basic-info-left" style="width:70%;float:left; margin-bottom: 0px">
                        <table style="width:100%">
                            <tbody>
                                <tr>
                                    <td style="width:30%"><strong>সম্পূর্ণ নাম</strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%"><strong>{{ $member->fullName }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>মোবাইল নাম্বার</strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%"><strong
                                            style="font-size: 14px;">{{ $member->phoneNumber }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>বাবার নাম</strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">{{ $family->father_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>মায়ের নাম</strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">{{ $family->mother_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>অন্য মোবাইল নাম্বার </strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%"><strong
                                            style="font-size: 14px;">{{ $family->alt_contact }}</strong></td>
                                </tr>

                                <tr>
                                    <td style="width:30%"><strong>বৈবাহিক অবস্থা </strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%;font-family: 'nikosh', sans-serif;">
                                        {{ $basicInfo->maritalstatus ? $basicInfo->maritalstatus->title : '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>বাচ্চার সংখ্যা </strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">{{ $basicInfo->children_no }}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>বয়স </strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">
                                        {{ App\Converter\enandbn\BanglaConverter::en2bn($basicInfo->age) }} বছর</td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>জন্ম তারিখ </strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">
                                        {{ App\Converter\enandbn\BanglaConverter::en2bn(date('j F Y ', strtotime($basicInfo->dob))) }}
                                    </td>

                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>ধর্ম </strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">
                                        {{ $basicInfo->religion ? $basicInfo->religion->title : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>ত্বকের রং</strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">
                                        {{ $basicInfo->pcomplexion ? $basicInfo->pcomplexion->title : '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%"><strong>উচ্চতা</strong></td>
                                    <td style="width:10%">:</td>
                                    <td style="width:60%">{{ $basicInfo->feet }} ফুট {{ $basicInfo->inch }} ইঞ্চি</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="basic-info-image" style="width:30%;float:left"></div>

                </div>
                <!-- basic info end -->
                <div class="education-info">
                    <div class="data-heading"
                        style="background:#ffcc00;padding:10px 15px;margin:15px 0;border-radius:5px !important">
                        <h3 style="font-size:18px;font-weight: normal;">শিক্ষাগত যোগ্যতা</h3>
                    </div>
                    <table class="table table-bordered">
                        <thead style="border:1px solid #ddd">
                            <tr style="border:1px solid #ddd">
                                <th
                                    style="border:1px solid #ddd; font-size:18px; background:#ffcc00;padding:5px 10px; font-weight: normal; text-align: center;">
                                    শিক্ষাগত যোগ্যতা</th>
                                <th
                                    style="border:1px solid #ddd; font-size:18px; background:#ffcc00;padding:5px 10px; font-weight: normal; text-align: center;">
                                    ডিগ্রীর নাম</th>
                                <th
                                    style="border:1px solid #ddd; font-size:18px; background:#ffcc00;padding:5px 10px; font-weight: normal; text-align: center;">
                                    অন্য কোন ডিগ্রীর নাম </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($educations as $key => $value)
                                <tr style="border:1px solid #ddd; display: flex;">
                                    <td style="border:1px solid #ddd;padding:5px 20px; text-align: center; width: 33%">
                                        <strong> {{ $value->education ? $value->education->title : '' }}</strong>
                                    </td>
                                    <td style="border:1px solid #ddd;padding:5px 20px; text-align: center; width: 33%">
                                        {{ $value->degree ? $value->degree->title : '' }}</td>
                                    <td style="border:1px solid #ddd;padding:5px 20px; text-align: center; width: 33%">
                                        {{ $value->alt_degree }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="education-info">
                    <div class="data-heading"
                        style="background:#ffcc00;padding:10px 15px;margin:15px 0;border-radius:5px !important">
                        <h3 style="font-size:18px;font-weight: normal;"> পেশাগত যোগ্যতা</h3>
                    </div>
                    <table class="table table-bordered">
                        <thead style="border:1px solid #ddd">
                            <tr style="border:1px solid #ddd">
                                <th
                                    style="border:1px solid #ddd; font-size:18px; background:#ffcc00;padding:5px 10px; font-weight: normal; text-align: center;width: 33%">
                                    পেশার নাম</th>
                                <th
                                    style="border:1px solid #ddd; font-size:18px; background:#ffcc00;padding:5px 10px; font-weight: normal; text-align: center;width: 33%">
                                    কর্মক্ষেত্র</th>
                                <th
                                    style="border:1px solid #ddd; font-size:18px; background:#ffcc00;padding:5px 10px; font-weight: normal; text-align: center;width: 33%">
                                    অন্য কোন পেশার নাম </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($educations as $key => $value)
                                <tr style="border:1px solid #ddd; display: flex;">
                                    <td style="border:1px solid #ddd;padding:5px 20px; text-align: center; width: 33%">
                                        <strong> {{ $career->profession ? $career->profession->title : '' }}</strong>
                                    </td>
                                    <td style="border:1px solid #ddd;padding:5px 20px; text-align: center; width: 33%">
                                        {{ $career->working ? $career->working->title : '' }}</td>
                                    <td style="border:1px solid #ddd;padding:5px 20px; text-align: center; width: 33%">
                                        {{ $career->profession_details }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="education-info">
                    <div class="data-heading"
                        style="background:#ffcc00;padding:10px 15px;margin:15px 0;border-radius:5px !important">
                        <h3 style="font-size:18px;font-weight:normal;">স্থায়ী ঠিকানা </h3>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="border: 1px solid #ddd; padding:5px 20px;">
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center;width: 33%">
                                    জাতীয়তা</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center;width: 33%">
                                    নাগরিকত্ব</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center;width: 33%">
                                    আবাস্থল</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 1px solid #ddd;">
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center;width: 33%">
                                    {{ $basicInfo->nationality ? $basicInfo->nationality->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center;width: 33%">
                                    {{ $basicInfo->country ? $basicInfo->country->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center;width: 33%">
                                    {{ $basicInfo->recidency ? $basicInfo->recidency->title : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="border: 1px solid #ddd; padding:5px 20px; display: flex;">
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center;width: 25%;">
                                    বিভাগ</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center;width: 25%;">
                                    জেলা</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center;width: 25%;">
                                    উপজেলা</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center;width: 25%;">
                                    গ্রাম / এরিয়া </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 1px solid #ddd;">
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center;width: 25%;">
                                    {{ $family->division ? $family->division->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center;width: 25%;">
                                    {{ $family->district ? $family->district->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center;width: 25%;">
                                    {{ $family->upazila ? $family->upazila->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center;width: 25%;">
                                    {{ $family ? $family->permanent_address : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="education-info">
                    <div class="data-heading"
                        style="background:#ffcc00;padding:10px 15px;margin:15px 0;border-radius:5px !important">
                        <h3 style="font-size:18px;font-weight:normal;">বর্তমান ঠিকানা</h3>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="border: 1px solid #ddd; padding:5px 20px;">
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center; width: 33%;">
                                    জাতীয়তা</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center; width: 33%;">
                                    নাগরিকত্ব</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center; width: 33%;">
                                    আবাস্থল</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 1px solid #ddd;">
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center; width: 33%;">
                                    {{ $basicInfo->nationality ? $basicInfo->nationality->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center; width: 33%;">
                                    {{ $basicInfo->country ? $basicInfo->country->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center; width: 33%;">
                                    {{ $basicInfo->recidency ? $basicInfo->recidency->title : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="border: 1px solid #ddd; padding:5px 20px; display: flex;">
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center; width: 25%;">
                                    বিভাগ</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center; width: 25%;">
                                    জেলা</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center; width: 25%;">
                                    উপজেলা</th>
                                <th
                                    style="border: 1px solid #ddd; font-weight: normal; background:#ffcc00; padding:5px 20px;font-size:18px;text-align:center; width: 25%;">
                                    গ্রাম / এরিয়া </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 1px solid #ddd;">
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center; width: 25%;">
                                    {{ $family->presentdivision ? $family->presentdivision->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center; width: 25%;">
                                    {{ $family->presentdistrict ? $family->presentdistrict->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center; width: 25%;">
                                    {{ $family->presentupazila ? $family->presentupazila->title : '' }}</td>
                                <td style="border: 1px solid #ddd; padding:5px 20px;text-align:center; width: 25%;">
                                    {{ $family->permanent_address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- education info end -->

            </div>
        </div>
    </div>

</body>

</html>
