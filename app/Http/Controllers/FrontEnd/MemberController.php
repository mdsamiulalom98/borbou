<?php

namespace App\Http\Controllers\FrontEnd;

use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Country;
use App\Models\Religion;
use App\Models\MaritalStatus;
use App\Models\Profession;
use App\Models\Working;
use App\Models\Location;
use App\Models\Degree;
use App\Models\BasicInfo;
use App\Models\EducationCareer;
use App\Models\FamilyLocation;
use App\Models\AboutMyself;
use App\Models\Complexion;
use App\Models\BloodGroup;
use App\Models\EducationValue;
use App\Models\Memberimage;
use App\Models\Monthname;
use App\Models\GeneralSetting;
use App\Models\OrderDetails;
use App\Models\Conversation;
use App\Models\Message;
use DateTime;
use PDF;

class MemberController extends Controller
{
    // ajax code
    public function getDegrees(Request $request)
    {
        $degrees = DB::table("degrees")
            ->where("parent_id", $request->level_id)
            ->pluck('title', 'id');
        return response()->json($degrees);
    }
    public function getDistricts(Request $request)
    {
        $districts = DB::table("locations")
            ->where("division_id", $request->division_id)
            ->where("district_id", 0)
            ->pluck('title', 'id');
        return response()->json($districts);
    }

    public function getUpazilas(Request $request)
    {
        $upazilas = DB::table("locations")
            ->where("district_id", $request->district_id)
            ->pluck('title', 'id');
        return response()->json($upazilas);
    }

    public function photo_load(Request $request)
    {
        $data = Memberimage::where('member_id', Auth::guard('member')->user()->id)->first();
        return view('frontEnd.layouts.ajax.photostoload', compact('data'));
    }

    public function register(Request $request)
    {
        $memberPhone = Member::where('phoneNumber', $request->phoneNumber)->first();
        if ($memberPhone) {
            Toastr::error('ফোন নম্বর আগে থেকেই আছে', 'Error');
            return redirect()->back();
        }
        $request->validate([
            'fullName' => 'required',
            'password' => 'required',
            'education_level' => 'required',
            'upazila_id' => 'required',
            'permanent_address' => 'required',
            'district_id' => 'required',
            'division_id' => 'required',
            'description' => 'required',
            'residency_id' => 'required',
            'nationality_id' => 'required',
            'complexion' => 'required',
            'religion_id' => 'required',
            'marital_status' => 'required',
            'working_id' => 'required',
            'profession_id' => 'required',
            'gender' => 'required',
            'inch' => 'required',
            'feet' => 'required',
            'year' => 'required',
            'month' => 'required',
            'day' => 'required',
            'country_id' => 'required',
            'image_one' => 'required',
            'image_two' => 'required',
            'image_three' => 'required',
            'phoneNumber' => 'required|unique:members|digits:11',
        ]);
        $verifyToken = rand(1111, 9999);

        $store_data = new Member();
        $store_data->fullName = $request->fullName;
        $store_data->phoneNumber = $request->phoneNumber;
        $store_data->gender = $request->gender;
        $store_data->verifyToken = $verifyToken;
        $store_data->account_type = 1;
        $store_data->status = 0;
        $store_data->publish = 0;
        $store_data->password = bcrypt(request('password'));
        $store_data->save();

        $bdate = $request->day;
        $bmonth = $request->month;
        $byear = $request->year;
        $dateofbirth = $byear . '-' . $bmonth . '-' . $bdate;

        $birthDate = $dateofbirth;
        $birthDateTime = new DateTime($birthDate);
        $todayDateTime = new DateTime();

        // Calculate the difference between the two dates
        $ageInterval = $birthDateTime->diff($todayDateTime);

        // Get the number of years from the DateInterval object
        $age = $ageInterval->y;

        // basic information
        $store_basicinfo = new BasicInfo();
        $store_basicinfo->member_id = $store_data->id;
        $store_basicinfo->fullName = $request->fullName;
        $store_basicinfo->nid_no = $request->nid_no;
        $store_basicinfo->passport_number = $request->passport_number;
        $store_basicinfo->birth_register = $request->birth_register;
        $store_basicinfo->children_no = $request->children_no;
        $store_basicinfo->marital_status = $request->marital_status;
        $store_basicinfo->nationality_id = $request->nationality_id;
        $store_basicinfo->residency_id = $request->residency_id;
        $store_basicinfo->country_id = $request->country_id;
        $store_basicinfo->religion_id = $request->religion_id;
        $store_basicinfo->gender = $request->gender;
        $store_basicinfo->feet = $request->feet;
        $store_basicinfo->inch = $request->inch;
        $store_basicinfo->complexion = $request->complexion;
        $store_basicinfo->dob = $dateofbirth;
        $store_basicinfo->age = $age;
        $store_basicinfo->division_id = $request->division_id;
        $store_basicinfo->district_id = $request->district_id;
        $store_basicinfo->upazila_id = $request->upazila_id;
        $store_basicinfo->present_address = $request->present_address ? $request->present_address : $request->permanent_address;
        $store_basicinfo->save();

        // eduction and career information
        $store_educationcareer = new EducationCareer();
        $store_educationcareer->member_id = $store_data->id;
        $store_educationcareer->working_id = $request->working_id;
        $store_educationcareer->profession_id = $request->profession_id;
        $store_educationcareer->profession_details = $request->profession_details;
        $store_educationcareer->save();

        $saveeducation = new EducationValue();
        $saveeducation->member_id = $store_data->id;
        $saveeducation->degree_id = $request->degree_id;
        $saveeducation->education_id = $request->education_level;
        $saveeducation->alt_degree = $request->alt_degree;
        $saveeducation->save();

        // member image information

        // image with intervention
        $image = $request->file('image_one');
        $name = time() . '-' . $image->getClientOriginalName();
        $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
        $name = strtolower(preg_replace('/\s+/', '-', $name));
        $uploadpath = 'public/uploads/member/';
        $imageUrl = $uploadpath . $name;
        $img = Image::make($image->getRealPath());
        $img->encode('webp', 90);
        $width = 300;
        $height = 300;

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->resizeCanvas($width, $height, 'center', false, '#ffffff');
        $img->save($imageUrl);

        // image with intervention
        $image2 = $request->file('image_two');
        $name2 = time() . '-' . $image2->getClientOriginalName();
        $name2 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name2);
        $name2 = strtolower(preg_replace('/\s+/', '-', $name2));
        $uploadpath2 = 'public/uploads/member/';
        $imageUrl2 = $uploadpath2 . $name2;
        $img2 = Image::make($image2->getRealPath());
        $img2->encode('webp', 90);
        $width2 = 300;
        $height2 = 300;
        $img2->resize($width2, $height2, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img2->resizeCanvas($width2, $height2, 'center', false, '#ffffff');
        $img2->save($imageUrl2);


        // image with intervention
        $image3 = $request->file('image_three');
        $name3 = time() . '-' . $image3->getClientOriginalName();
        $name3 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name3);
        $name3 = strtolower(preg_replace('/\s+/', '-', $name3));
        $uploadpath3 = 'public/uploads/member/';
        $imageUrl3 = $uploadpath3 . $name3;
        $img3 = Image::make($image3->getRealPath());
        $img3->encode('webp', 90);
        $width3 = 300;
        $height3 = 300;
        $img3->resize($width3, $height3, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img3->resizeCanvas($width3, $height3, 'center', false, '#ffffff');
        $img3->save($imageUrl3);

        $store_memberimage = new Memberimage();
        $store_memberimage->member_id = $store_data->id;
        $store_memberimage->image_one = $imageUrl;
        $store_memberimage->image_two = $imageUrl2;
        $store_memberimage->image_three = $imageUrl3;
        $store_memberimage->save();

        $store_familylocation = new FamilyLocation();
        $store_familylocation->member_id = $store_data->id;
        $store_familylocation->father_name = $request->father_name;
        $store_familylocation->alt_contact = $request->alt_contact;
        $store_familylocation->mother_name = $request->mother_name;
        $store_familylocation->division_id = $request->division_id;
        $store_familylocation->district_id = $request->district_id;
        $store_familylocation->upazila_id = $request->upazila_id;
        $store_familylocation->permanent_address = $request->permanent_address;
        if ($request->same_address == 1) {
            $store_familylocation->present_division = $request->division_id;
            $store_familylocation->present_district = $request->district_id;
            $store_familylocation->present_upazila = $request->upazila_id;
            $store_familylocation->present_address = $request->permanent_address;
        } else {
            $store_familylocation->present_division = $request->present_division;
            $store_familylocation->present_district = $request->present_district;
            $store_familylocation->present_upazila = $request->present_upazila;
            $store_familylocation->present_address = $request->present_address;
        }
        $store_familylocation->save();

        // about myself data
        $store_aboutme = new AboutMyself();
        $store_aboutme->member_id = $store_data->id;
        $store_aboutme->description = $request->description;
        $store_aboutme->save();

        // member id put
        $memberId = $store_data->id;
        Session::put('initpassword', $request->password);
        Session::put('phoneverify', $request->phoneNumber);
        Session::put('memberId', $memberId);

        $token = "94781234491684132489e2a87f2138dd7150495cde9bf255c32d";
        $message = "(বর বউ) ওয়েবসাইটের ভেরিফিকেশন কোড $verifyToken, ধন্যবাদ।";

        $url = "http://api.greenweb.com.bd/api.php";
        $data = array(
            'to' => $request->phoneNumber,
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

        Toastr::success('মোবাইল নাম্বারে কোড (ওটিপি)পাঠানো হয়েছে');
        return redirect()->route('verify_form');
    }

    public function registermissingstore(Request $request)
    {
        $memberPhone = Member::where('phoneNumber', $request->phoneNumber)->first();
        if ($memberPhone) {
            Toastr::error('ফোন নম্বর আগে থেকেই আছে', 'Error');
            return redirect()->back();
        }

        $verifyToken = rand(1111, 9999);

        $store_data = new Member();
        $store_data->id = $request->id;
        $store_data->fullName = $request->fullName;
        $store_data->phoneNumber = $request->phoneNumber;
        $store_data->gender = $request->gender;
        $store_data->verifyToken = $verifyToken;
        $store_data->account_type = 1;
        $store_data->status = 0;
        $store_data->publish = 0;
        $store_data->password = bcrypt(request('password'));
        $store_data->save();

        $bdate = $request->day;
        $bmonth = $request->month;
        $byear = $request->year;
        $dateofbirth = $byear . '-' . $bmonth . '-' . $bdate;

        $birthDate = $dateofbirth;
        $birthDateTime = new DateTime($birthDate);
        $todayDateTime = new DateTime();

        // Calculate the difference between the two dates
        $ageInterval = $birthDateTime->diff($todayDateTime);

        // Get the number of years from the DateInterval object
        $age = $ageInterval->y;

        // basic information
        $store_basicinfo = new BasicInfo();
        $store_basicinfo->member_id = $store_data->id;
        $store_basicinfo->fullName = $request->fullName;
        $store_basicinfo->nid_no = $request->nid_no;
        $store_basicinfo->passport_number = $request->passport_number;
        $store_basicinfo->birth_register = $request->birth_register;
        $store_basicinfo->children_no = $request->children_no;
        $store_basicinfo->marital_status = $request->marital_status;
        $store_basicinfo->nationality_id = $request->nationality_id;
        $store_basicinfo->residency_id = $request->residency_id;
        $store_basicinfo->country_id = $request->country_id;
        $store_basicinfo->religion_id = $request->religion_id;
        $store_basicinfo->gender = $request->gender;
        $store_basicinfo->feet = $request->feet;
        $store_basicinfo->inch = $request->inch;
        $store_basicinfo->complexion = $request->complexion;
        $store_basicinfo->dob = $dateofbirth;
        $store_basicinfo->age = $age;
        $store_basicinfo->division_id = $request->division_id;
        $store_basicinfo->district_id = $request->district_id;
        $store_basicinfo->upazila_id = $request->upazila_id;
        $store_basicinfo->present_address = $request->present_address ? $request->present_address : $request->permanent_address;
        $store_basicinfo->save();

        // eduction and career information
        $store_educationcareer = new EducationCareer();
        $store_educationcareer->member_id = $store_data->id;
        $store_educationcareer->working_id = $request->working_id;
        $store_educationcareer->profession_id = $request->profession_id;
        $store_educationcareer->profession_details = $request->profession_details;
        $store_educationcareer->save();

        $saveeducation = new EducationValue();
        $saveeducation->member_id = $store_data->id;
        $saveeducation->degree_id = $request->degree_id;
        $saveeducation->education_id = $request->education_level;
        $saveeducation->alt_degree = $request->alt_degree;
        $saveeducation->save();

        // member image information

        // image with intervention
        $image = $request->file('image_one');
        $name = time() . '-' . $image->getClientOriginalName();
        $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
        $name = strtolower(preg_replace('/\s+/', '-', $name));
        $uploadpath = 'public/uploads/member/';
        $imageUrl = $uploadpath . $name;
        $img = Image::make($image->getRealPath());
        $img->encode('webp', 90);
        $width = 300;
        $height = 300;

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->resizeCanvas($width, $height, 'center', false, '#ffffff');
        $img->save($imageUrl);

        // image with intervention
        $image2 = $request->file('image_two');
        $name2 = time() . '-' . $image2->getClientOriginalName();
        $name2 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name2);
        $name2 = strtolower(preg_replace('/\s+/', '-', $name2));
        $uploadpath2 = 'public/uploads/member/';
        $imageUrl2 = $uploadpath2 . $name2;
        $img2 = Image::make($image2->getRealPath());
        $img2->encode('webp', 90);
        $width2 = 300;
        $height2 = 300;
        $img2->resize($width2, $height2, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img2->resizeCanvas($width2, $height2, 'center', false, '#ffffff');
        $img2->save($imageUrl2);


        // image with intervention
        $image3 = $request->file('image_three');
        $name3 = time() . '-' . $image3->getClientOriginalName();
        $name3 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name3);
        $name3 = strtolower(preg_replace('/\s+/', '-', $name3));
        $uploadpath3 = 'public/uploads/member/';
        $imageUrl3 = $uploadpath3 . $name3;
        $img3 = Image::make($image3->getRealPath());
        $img3->encode('webp', 90);
        $width3 = 300;
        $height3 = 300;
        $img3->resize($width3, $height3, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img3->resizeCanvas($width3, $height3, 'center', false, '#ffffff');
        $img3->save($imageUrl3);

        $store_memberimage = new Memberimage();
        $store_memberimage->member_id = $store_data->id;
        $store_memberimage->image_one = $imageUrl;
        $store_memberimage->image_two = $imageUrl2;
        $store_memberimage->image_three = $imageUrl3;
        $store_memberimage->save();

        $store_familylocation = new FamilyLocation();
        $store_familylocation->member_id = $store_data->id;
        $store_familylocation->father_name = $request->father_name;
        $store_familylocation->alt_contact = $request->alt_contact;
        $store_familylocation->mother_name = $request->mother_name;
        $store_familylocation->division_id = $request->division_id;
        $store_familylocation->district_id = $request->district_id;
        $store_familylocation->upazila_id = $request->upazila_id;
        $store_familylocation->permanent_address = $request->permanent_address;
        if ($request->same_address == 1) {
            $store_familylocation->present_division = $request->division_id;
            $store_familylocation->present_district = $request->district_id;
            $store_familylocation->present_upazila = $request->upazila_id;
            $store_familylocation->present_address = $request->permanent_address;
        } else {
            $store_familylocation->present_division = $request->present_division;
            $store_familylocation->present_district = $request->present_district;
            $store_familylocation->present_upazila = $request->present_upazila;
            $store_familylocation->present_address = $request->present_address;
        }
        $store_familylocation->save();

        // about myself data
        $store_aboutme = new AboutMyself();
        $store_aboutme->member_id = $store_data->id;
        $store_aboutme->description = $request->description;
        $store_aboutme->save();


    }

    public function login(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|digits:11',
            'password' => 'required',
        ]);
        $memberCheck = Member::where('phoneNumber', $request->phoneNumber)->first();

        if ($memberCheck) {
            if ($memberCheck->status != 1) {
                Toastr::success('আপনার অ্যাকাউন্ট স্থগিত করা হয়েছে');
                Session::put('phoneverify', $memberCheck->phoneNumber);

                $token = "94781234491684132489e2a87f2138dd7150495cde9bf255c32d";
                $message = "(বর বউ) ওয়েবসাইটের ভেরিফিকেশন কোড $memberCheck->verifyToken, ধন্যবাদ।";

                $url = "http://api.greenweb.com.bd/api.php";
                $data = array(
                    'to' => $memberCheck->phoneNumber,
                    'message' => "$message",
                    'token' => "$token"
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $smsresult = curl_exec($ch);

                return redirect()->route('verify_form');
            } else {
                $credentials = ['phoneNumber' => $request->phoneNumber, 'password' => $request->password];
                if (Auth::guard('member')->attempt($credentials)) {
                    Toastr::success('আপনি লগিন সফল হয়েছে');
                    if (Cart::instance('wishlist')->count() > 0) {
                        return redirect()->route('wishlist');
                    }
                    return redirect()->route('member.editprofile');
                } else {
                    Toastr::error('ভুল পাসওয়ার্ড !');
                    return redirect()->back();
                }
            }
        } else {
            Toastr::error('আপনার কোন একাউন্ট নেই');
            return redirect()->back();
        }
    }

    public function forgotpassword()
    {
        return view('frontEnd.member.forgotpassword');
    }

    public function forgotsubmit(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'required',
        ]);

        $verified = Member::where('phoneNumber', $request->phoneNumber)->first();
        if (!$verified) {
            Toastr::error('আপনার ফোন নম্বর আমাদের ডাটাবেসে নেই');
            return redirect()->back();
        } else {
            $verifyToken = rand(1111, 9999);
            // member id put

            $store_verify = Member::where('id', $verified->id)->first();
            $store_verify->passResetToken = $verifyToken;
            $store_verify->save();

            Session::put('phoneverify', $request->phoneNumber);

            $token = "94781234491684132489e2a87f2138dd7150495cde9bf255c32d";
            $message = "(বর বউ) ওয়েবসাইটের ভেরিফিকেশন কোড $verifyToken, ধন্যবাদ।";

            $url = "http://api.greenweb.com.bd/api.php";
            $data = array(
                'to' => $request->phoneNumber,
                'message' => "$message",
                'token' => "$token"
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);

            return redirect()->route('member.passresetpage');
        }
    }

    public function passresetpage()
    {
        return view('frontEnd.member.passwordreset');
    }

    public function passResetVerify(Request $request)
    {
        $this->validate($request, [
            'passResetToken' => 'required',
            'password' => 'required',
        ]);

        $verified = Member::where('phoneNumber', Session::get('phoneverify'))->first();
        $verifydbtoken = $verified->passResetToken;
        $verifyformtoken = $request->passResetToken;
        if ($verifydbtoken == $verifyformtoken) {
            $verified->passResetToken = 1;
            $verified->password = bcrypt(request('password'));
            $verified->save();
            Toastr::error('আপনার একাউন্টের পাসওয়ার্ড পুনরায় রিসেট করা হয়েছে।');
            return redirect()->route('member.login');
        } else {
            Toastr::error('আপনার ভেরিফিকেশন কোড ভুল হয়েছে।');
            return redirect()->back();
        }
    }

    public function editProfile()
    {
        $edulevels = Degree::where('parent_id', 0)->get();
        $selectedulevel = EducationValue::where('member_id', Auth::guard('member')->user()->id)->first();
        if ($selectedulevel) {
            $selectedulevel = $selectedulevel->education_id;
        } else {
            $selectedulevel = 1;
        }
        $degrees = Degree::where('parent_id', $selectedulevel)->get();
        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        $bloodgroups = BloodGroup::get();
        $complexions = Complexion::get();
        $professions = Profession::orderBy('id', 'asc')->get();
        $workings = Working::orderBy('id', 'asc')->get();
        $nationalities = Country::orderBy('id', 'asc')->get();
        $monthnames = Monthname::orderBy('id', 'asc')->get();
        $religions = Religion::orderBy('id', 'asc')->get();
        $locations = Location::orderBy('serial', 'asc')->where(['division_id' => 0, 'district_id' => 0])->get();

        $memberInfo = Member::findOrFail(Auth::guard('member')->user()->id);
        $basicInformation = BasicInfo::where('member_id', $memberInfo->id)->with('maritalstatus', 'religion', 'country', 'nationality', 'pcomplexion')->first();
        if ($basicInformation) {
            $memberEdit = Member::where('id', Auth::guard('member')->user()->id)->first();
            $memberEdit->gender = $basicInformation->gender;
            $memberEdit->save();
        }
        $educationcareer = EducationCareer::where('member_id', $memberInfo->id)->with('working', 'profession')->first();

        $educationalvalues = EducationValue::orderBy('degree_id', 'desc')->where('member_id', $memberInfo->id)->with('degree', 'education')->first();
        $familylocation = FamilyLocation::where('member_id', $memberInfo->id)->with('division', 'district', 'upazila')->first();

        $permanent_dists = Location::orderBy('id', 'asc')->where(['division_id' => $familylocation ? $familylocation->division_id : '', 'district_id' => 0])->get();
        $permanent_upazillas = Location::orderBy('id', 'ASC')->where(['district_id' => $familylocation ? $familylocation->district_id : ''])->get();

        $present_dists = Location::orderBy('id', 'asc')->where(['division_id' => $familylocation ? $familylocation->present_division : '', 'district_id' => 0])->get();
        $present_upazillas = Location::orderBy('id', 'ASC')->where(['district_id' => $familylocation ? $familylocation->present_district : ''])->get();


        $memberimage = Memberimage::where('member_id', $memberInfo->id)->first();

        $aboutmyself = AboutMyself::where('member_id', $memberInfo->id)->first();

        return view('frontEnd.member.editprofile', compact('edulevels', 'maritalstatuses', 'bloodgroups', 'complexions', 'professions', 'workings', 'locations', 'nationalities', 'monthnames', 'religions', 'memberInfo', 'basicInformation', 'educationcareer', 'educationalvalues', 'familylocation', 'aboutmyself', 'memberimage', 'permanent_dists', 'permanent_upazillas', 'present_dists', 'present_upazillas', 'degrees'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'fullName' => 'required',
            'education_level' => 'required',
            'upazila_id' => 'required',
            'permanent_address' => 'required',
            'district_id' => 'required',
            'division_id' => 'required',
            'description' => 'required',
            'residency_id' => 'required',
            'nationality_id' => 'required',
            'complexion' => 'required',
            'religion_id' => 'required',
            'marital_status' => 'required',
            'working_id' => 'required',
            'profession_id' => 'required',
            'gender' => 'required',
            'inch' => 'required',
            'feet' => 'required',
            'year' => 'required',
            'month' => 'required',
            'day' => 'required',
            'country_id' => 'required',
        ]);
        $memberId = Auth::guard('member')->user()->id;
        $memberInfo = Member::where('id', $memberId)->first();
        $memberInfo->gender = $request->gender;
        $memberInfo->save();
        $bdate = $request->day;
        $bmonth = $request->month;
        $byear = $request->year;
        $dateofbirth = $byear . '-' . $bmonth . '-' . $bdate;

        $birthDate = $dateofbirth; // Example birth date
        $birthDateTime = new DateTime($birthDate);
        $todayDateTime = new DateTime();

        // Calculate the difference between the two dates
        $ageInterval = $birthDateTime->diff($todayDateTime);
        // Get the number of years from the DateInterval object
        $age = $ageInterval->y;
        // basic information


        if (!empty($request->basicinfo) && is_numeric($request->basicinfo)) {
            $update_basicinfo = BasicInfo::find($request->basicinfo);
        } else {
            $update_basicinfo = new BasicInfo();
        }
        $update_basicinfo->member_id = $memberId;
        $update_basicinfo->fullName = $request->fullName;
        $update_basicinfo->nid_no = $request->nid_no;
        $update_basicinfo->passport_number = $request->passport_number;
        $update_basicinfo->birth_register = $request->birth_register;
        $update_basicinfo->children_no = $request->children_no;
        $update_basicinfo->marital_status = $request->marital_status;
        $update_basicinfo->nationality_id = $request->nationality_id;
        $update_basicinfo->residency_id = $request->residency_id;
        $update_basicinfo->country_id = $request->country_id;
        $update_basicinfo->religion_id = $request->religion_id;
        $update_basicinfo->gender = $request->gender;
        $update_basicinfo->feet = $request->feet;
        $update_basicinfo->inch = $request->inch;
        $update_basicinfo->complexion = $request->complexion;
        $update_basicinfo->dob = $dateofbirth;
        $update_basicinfo->age = $age;
        $update_basicinfo->division_id = $request->division_id;
        $update_basicinfo->district_id = $request->district_id;
        $update_basicinfo->upazila_id = $request->upazila_id;
        $update_basicinfo->present_address = $request->present_address ? $request->present_address : $request->permanent_address;
        $update_basicinfo->save();

        // eduction and career information
        if (!empty($request->educationcareer) && is_numeric($request->educationcareer)) {
            $update_educationcareer = EducationCareer::find($request->educationcareer);
        } else {
            $update_educationcareer = new EducationCareer();
        }
        $update_educationcareer->member_id = $memberId;
        $update_educationcareer->working_id = $request->working_id;
        $update_educationcareer->profession_id = $request->profession_id;
        $update_educationcareer->profession_details = $request->profession_details;
        $update_educationcareer->save();

        if (!empty($request->educationvalue) && is_numeric($request->educationvalue)) {
            $update_ducation = EducationValue::find($request->educationvalue);
        } else {
            $update_ducation = new EducationValue();
        }
        $update_ducation->member_id = $memberId;
        $update_ducation->degree_id = $request->degree_id;
        $update_ducation->education_id = $request->education_level;
        $update_ducation->alt_degree = $request->alt_degree;
        $update_ducation->save();

        if (!empty($request->memberimage) && is_numeric($request->memberimage)) {
            $update_memberimage = Memberimage::find($request->memberimage);
        } else {
            $update_memberimage = new Memberimage();
        }
        // member image information
        $image = $request->file('image_one');
        if ($image) {
            // image with intervention
            $image = $request->file('image_one');
            $name = time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/member/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = 300;
            $height = 300;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->resizeCanvas($width, $height, 'center', false, '#ffffff');
            $img->save($imageUrl);
        } else {
            $imageUrl = $update_memberimage->image_one;
        }

        // member image information
        $image2 = $request->file('image_two');
        if ($image2) {
            // image with intervention
            $image2 = $request->file('image_two');
            $name2 = time() . '-' . $image2->getClientOriginalName();
            $name2 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name2);
            $name2 = strtolower(preg_replace('/\s+/', '-', $name2));
            $uploadpath2 = 'public/uploads/member/';
            $imageUrl2 = $uploadpath2 . $name2;
            $img2 = Image::make($image2->getRealPath());
            $img2->encode('webp', 90);
            $width2 = 300;
            $height2 = 300;
            $img2->resize($width2, $height2, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img2->resizeCanvas($width2, $height2, 'center', false, '#ffffff');
            $img2->save($imageUrl2);
        } else {
            $imageUrl2 = $update_memberimage->image_two;
        }

        // member image information
        $image3 = $request->file('image_three');
        if ($image3) {
            // image with intervention
            $image3 = $request->file('image_three');
            $name3 = time() . '-' . $image3->getClientOriginalName();
            $name3 = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name3);
            $name3 = strtolower(preg_replace('/\s+/', '-', $name3));
            $uploadpath3 = 'public/uploads/member/';
            $imageUrl3 = $uploadpath3 . $name3;
            $img3 = Image::make($image3->getRealPath());
            $img3->encode('webp', 90);
            $width3 = 300;
            $height3 = 300;
            $img3->resize($width3, $height3, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img3->resizeCanvas($width3, $height3, 'center', false, '#ffffff');
            $img3->save($imageUrl3);
        } else {
            $imageUrl3 = $update_memberimage->image_three;
        }

        $update_memberimage->member_id = $memberId;
        $update_memberimage->image_one = $imageUrl;
        $update_memberimage->image_two = $imageUrl2;
        $update_memberimage->image_three = $imageUrl3;
        $update_memberimage->save();


        if (!empty($request->familylocation) && is_numeric($request->familylocation)) {
            $update_familylocation = FamilyLocation::find($request->familylocation);
        } else {
            $update_familylocation = new FamilyLocation();
        }
        $update_familylocation->member_id = $memberId;
        $update_familylocation->father_name = $request->father_name;
        $update_familylocation->mother_name = $request->mother_name;
        $update_familylocation->alt_contact = $request->alt_contact;
        $update_familylocation->division_id = $request->division_id;
        $update_familylocation->district_id = $request->district_id;
        $update_familylocation->upazila_id = $request->upazila_id;
        $update_familylocation->permanent_address = $request->permanent_address;
        if ($request->same_address == 1) {
            $update_familylocation->present_division = $request->division_id;
            $update_familylocation->present_district = $request->district_id;
            $update_familylocation->present_upazila = $request->upazila_id;
            $update_familylocation->present_address = $request->permanent_address;
        } else {
            $update_familylocation->present_division = $request->present_division;
            $update_familylocation->present_district = $request->present_district;
            $update_familylocation->present_upazila = $request->present_upazila;
            $update_familylocation->present_address = $request->present_address;
        }
        $update_familylocation->save();

        // about myself data

        $update_aboutme = AboutMyself::find($request->aboutme);
        if ($update_aboutme) {
            $update_aboutme->member_id = $memberId;
            $update_aboutme->description = $request->description;
            $update_aboutme->save();
        } else {
            $update_aboutme = AboutMyself::firstOrCreate([
                'member_id' => $memberId,
            ], [
                'member_id' => $memberId,
                'description' => $request->description
            ]);
        }

        Session::forget('admin_login');
        Toastr::success('আপনার সংশোধন সফল হয়েছে');
        return redirect()->route('member.editprofile');
    }

    public function deleteImageOne($id)
    {
        $delete_image = Memberimage::find($id);
        File::delete($delete_image->image_one);
        $delete_image->image_one = NULL;
        $delete_image->save();
        return response()->json($delete_image);
    }

    public function deleteImageTwo($id)
    {
        $delete_image = Memberimage::find($id);
        File::delete($delete_image->image_two);
        $delete_image->image_two = NULL;
        $delete_image->save();

        return response()->json($delete_image);
    }

    public function deleteImageThree($id)
    {
        $delete_image = Memberimage::find($id);
        File::delete($delete_image->image_three);
        $delete_image->image_three = NULL;
        $delete_image->save();

        return response()->json($delete_image);
    }

    public function memberVerifyForm()
    {
        $member = Member::where('phoneNumber', Session::get('phoneverify'))->select('phoneNumber', 'id', 'verifyToken')->first();
        return view('frontEnd.member.verify', compact('member'));
    }

    public function memberVerify(Request $request)
    {
        $this->validate($request, [
            'verifyPin' => 'required',
        ]);

        $verified = Member::where('phoneNumber', Session::get('phoneverify'))->first();
        $verifydbtoken = $verified->verifyToken;
        $verifyformtoken = $request->verifyPin;
        if ($verifydbtoken == $verifyformtoken) {
            $verified->verifyToken = 1;
            $verified->status = 1;
            $verified->save();
            Toastr::success('আপনার একাউন্ট ভেরিফাই হয়েছে');
            $credentials = ['phoneNumber' => $verified->phoneNumber, 'password' => Session::get('initpassword')];
            if (Auth::guard('member')->attempt($credentials)) {
                Toastr::error('রেজিস্ট্রেশন ফি প্রদান করুন');
                return redirect()->route('member.editprofile');
            }
        } else {
            Toastr::error('আপনার ভেরিফিকেশন কোড ভুল হয়েছে।');
            return redirect()->back();
        }
    }

    public function resendcode(Request $request)
    {
        $verifyToken = rand(1111, 9999);
        $findmember = Member::where('phoneNumber', Session::get('phoneverify'))->first();
        $findmember->verifyToken = $verifyToken;
        $findmember->save();

        $phoneNumber = Session::get('phoneverify');

        $token = "94781234491684132489e2a87f2138dd7150495cde9bf255c32d";
        $message = "(বর বউ) ওয়েবসাইটের ভেরিফিকেশন কোড $verifyToken, ধন্যবাদ।";

        $url = "http://api.greenweb.com.bd/api.php";
        $data = array(
            'to' => $phoneNumber,
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

        Toastr::error('আপনার ওটিপি টোকেন আবার পাঠানো হয়েছে!');
        return redirect()->route('verify_form');
    }

    public function member_publish(Request $request)
    {
        $info = array(
            'currency' => "BDT",
            'amount' => 499,
            'order_id' => uniqid(),
            'discsount_amount' => 0,
            'disc_percent' => 0,
            'client_ip' => "https://borbou.com.bd/",
            'customer_name' => Auth::guard('member')->user()->fullName ?? 'Customer',
            'customer_phone' => Auth::guard('member')->user()->phoneNumber ?? '01700000000',
            'email' => "customer@shuvokaj.com",
            'customer_address' => "Nimnagar, Balubari, Dinajpur",
            'customer_city' => "Dinajpur",
            'customer_state' => "Dinajpur",
            'customer_postcode' => "1212",
            'customer_country' => "BD",
            'value1' => "member_publish",
            'value2' => 'Account Publish',
        );
        $shurjopay_service = new ShurjopayController();
        return $shurjopay_service->checkout($info);
    }
    public function make_premium(Request $request)
    {
        if ($request->plan == 1) {
            $amount = 100;
            $date = 30;
        } elseif ($request->plan == 2) {
            $amount = 250;
            $date = 90;
        } else {
            $amount = 500;
            $date = 180;
        }
        $info = array(
            'currency' => "BDT",
            'amount' => $amount,
            'order_id' => uniqid(),
            'discsount_amount' => 0,
            'disc_percent' => 0,
            'client_ip' => "https://borbou.com.bd/",
            'customer_name' => Auth::guard('member')->user()->fullName ?? 'Customer',
            'customer_phone' => Auth::guard('member')->user()->phoneNumber ?? '01700000000',
            'email' => "customer@shuvokaj.com",
            'customer_address' => "Nimnagar, Balubari, Dinajpur",
            'customer_city' => "Dinajpur",
            'customer_state' => "Dinajpur",
            'customer_postcode' => "1212",
            'customer_country' => "BD",
            'value1' => "member_payment",
            'value2' => $request->plan,
            'value3' => $date,
        );
        $shurjopay_service = new ShurjopayController();
        return $shurjopay_service->checkout($info);
    }

    public function download()
    {
        $datas = OrderDetails::where(['status' => 1, 'member_id' => Auth::guard('member')->user()->id])->get();
        return view('frontEnd.download.download', compact('datas'));
    }
    public function download_pdf(Request $request)
    {
        $pdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh'
        ]);
        $member = Member::where(['id' => $request->member_id, 'status' => '1'])->first();
        if (!$member) {
            Toastr::error('এই সদস্যের তথ্য মুছে ফেলা হয়েছে');
            return redirect()->back();
        }
        $basicInfo = BasicInfo::where('member_id', $member->id)->latest()->with('maritalstatus', 'religion', 'country', 'nationality', 'recidency')->first();
        $pdf_image = Memberimage::where('member_id', $member->id)->first();
        $career = EducationCareer::latest()->where('member_id', $member->id)->with('working', 'profession')->firstOrfail();
        $educations = EducationValue::orderBy('degree_id', 'desc')->latest()->where('member_id', $member->id)->with('degree', 'degree.educationcat')->get();
        $family = FamilyLocation::latest()->where('member_id', $member->id)->first();
        $aboutmyself = AboutMyself::latest()->where('member_id', $member->id)->first();
        $logo = GeneralSetting::first();
        $pdf = PDF::loadView('frontEnd.download.pdf', compact('member', 'basicInfo', 'pdf_image', 'career', 'educations', 'family', 'logo', 'aboutmyself'));
        return $pdf->stream('biodata.pdf');
    }
    public function delete_pdf(Request $request)
    {
        $order = Orderdetails::find($request->id);
        $order->delete();
        Toastr::error('প্রোফাইল পিডিএফ মুছে গেছে');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route('member.login');
    }

    public function conversation_create(Request $request)
    {
        Session::forget('messages');
        if (!Auth::guard('member')->check()) {
            return response()->json(['success' => false, 'status' => 'unlogged', 'message' => 'আগে লগিন করুন।']);
        }

        if (Auth::guard('member')->user()->publish != 1) {
            return response()->json(['success' => false, 'status' => 'unpublished', 'message' => 'আপনার একাউন্ট টি পাবলিশ হয়নি']);
        }

        $loggedInMemberId = Auth::guard('member')->user()->id;
        $memberTwoId = $request->id;

        $conversation = Conversation::where(function ($query) use ($loggedInMemberId, $memberTwoId) {
            $query->where('member_one_id', $loggedInMemberId)
                ->where('member_two_id', $memberTwoId);
        })->orWhere(function ($query) use ($loggedInMemberId, $memberTwoId) {
            $query->where('member_one_id', $memberTwoId)
                ->where('member_two_id', $loggedInMemberId);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'member_one_id' => $loggedInMemberId,
                'member_two_id' => $memberTwoId,
            ]);
        }

        Session::put('conversation_id', $conversation->id);
        $idList = collect(session('conversations', []));
        $idList = $idList->push($conversation->id)->unique()->values();
        Session::put('conversations', $idList->toArray());
        $messages = Message::where(['conversation_id' => $conversation->id])->limit(8)->get();
        Session::put('messages', $messages);
        return response()->json(['success' => true, 'conversation' => $conversation]);
    }

    public function message_reload(Request $request)
    {
        $conversation = Conversation::where(['id' => $request->id])->first();
        $messages = Message::where(['conversation_id' => $conversation->id])->limit(8)->get();
        Session::put('messages', $messages);
        return view('frontEnd.layouts.ajax.messages', compact('conversation'));
    }
    public function message_header(Request $request)
    {
        $conversation = Conversation::where(['id' => $request->id])->with('member_one', 'member_two')->first();
        $loggedInMemberId = Auth::guard('member')->user()->id;
        $record = Conversation::where('member_one_id', $loggedInMemberId)->first();
        $conversationMemberImage = $record
            ? $conversation->member_two->memberimage->image_one
            : $conversation->member_one->memberimage->image_one;
        return view('frontEnd.layouts.ajax.messagehead', compact('conversation', 'record', 'conversationMemberImage'));
    }

    public function message_update(Request $request)
    {
        $conversation = Conversation::where(['id' => $request->id])->first();
        $senderId = Auth::guard('member')->user()->id;
        $messageContent = $request->messageContent;
        $conversation->messages()->create([
            'sender_id' => $senderId,
            'content' => $messageContent,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $messages = Message::where(['conversation_id' => $conversation->id])->limit(8)->get();
        Session::put('messages', $messages);
        return response()->json(['success' => true, 'conversation' => $conversation]);
    }
    public function remove_session()
    {
        Session::forget('conversation_id');
        return response()->json(['success' => true]);
    }

    public function message_page(Request $request) {
        $loggedInMemberId = Auth::guard('member')->user()->id;

        $conversations = Conversation::where(function ($query) use ($loggedInMemberId) {
            $query->where('member_one_id', $loggedInMemberId);
        })->orWhere(function ($query) use ($loggedInMemberId) {
            $query->where('member_two_id', $loggedInMemberId);
        })->get();
        // $conversations = Conversation::all();
        // return $conversations;
        return view('frontEnd.member.messages', compact('conversations'));
    }
}
