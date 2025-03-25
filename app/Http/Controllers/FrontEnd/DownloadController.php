<?php

namespace App\Http\Controllers\FrontEnd;

use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Member;
use App\Models\OrderDetails;
use App\Models\BasicInfo;
use App\Models\Memberimage;
use App\Models\EducationCareer;
use App\Models\EducationValue;
use App\Models\GeneralSetting;
use App\Models\FamilyLocation;
use App\Models\AboutMyself;

class DownloadController extends Controller
{
    // wishlist script
    public function add_to_wishlist(Request $request)
    {
        $member = Member::where(['id' => $request->member_id])->select('id', 'fullName')->first();
        $basicInfo = BasicInfo::where(['member_id' => $request->member_id])->select('id', 'fullName', 'member_id')->first();

        if (!$member || !$basicInfo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid member information.'
            ], 400); // Bad Request
        }

        $exists = Cart::instance('wishlist')->content()->where('id', $member->id)->count();

        if ($exists == 1) {
            $message = 'তালিকায় যুক্ত রয়েছে'; // "Already added to the list" in Bengali
            $status = 'error';

            if ($request->download == 'true') {
                if (Auth::guard('member')->user() && Auth::guard('member')->user()->publish == 1) {
                    return response()->json([
                        'status' => 'redirect',
                        'message' => $message,
                        'redirect_url' => route('wishlist')
                    ]);
                } else {
                    return response()->json([
                        'status' => $status,
                        'message' => $message,
                        'redirect_url' => url()->previous()
                    ]);
                }
            }

            return response()->json([
                'status' => $status,
                'message' => $message
            ]);
        } else {
            $qty = 1;
            $price = 99;
            $image = Memberimage::where('member_id', $member->id)->latest()->first();
            Cart::instance('wishlist')->add([
                'id' => $member->id,
                'name' => $basicInfo->fullName,
                'qty' => $qty,
                'price' => $price,
                'options' => [
                    'image' => $image ? $image->image_one : '',
                    'member_id' => $member->id
                ]
            ]);

            $message = 'তালিকায় যুক্ত হয়েছে'; // "Added to the list" in Bengali
            $status = 'success';
            $wishlistCount = Cart::instance('wishlist')->count();
            if ($request->download) {
                if (Auth::guard('member')->user()?->publish == 1) {
                    return response()->json([
                        'status' => 'redirect',
                        'message' => $message,
                        'redirect_url' => route('wishlist')
                    ]);
                } else {
                    return response()->json([
                        'status' => $status,
                        'wishlist_count' => $wishlistCount,
                        'message' => $message,
                        'redirect_url' => url()->previous()
                    ]);
                }
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'wishlist_count' => $wishlistCount,
            ]);
        }
    }


    public function wishlist(Request $request)
    {
        if (!empty($request->all())) {
            $member = Member::where(['id' => $request->id])->select('id', 'fullName')->first();
            $basicInfo = BasicInfo::where(['member_id' => $member->id])->select('id', 'fullName', 'member_id')->first();

            if (!$member || !$basicInfo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid member information.'
                ], 400); // Bad Request
            }
            $exists = Cart::instance('wishlist')->content()->where('id', $member->id)->count();
            if ($exists == 1) {
                Toastr::error('তালিকায় যুক্ত রয়েছে');
            } else {
                $qty = 1;
                $price = 99;
                $image = Memberimage::where('member_id', $member->id)->latest()->first();
                Cart::instance('wishlist')->add([
                    'id' => $member->id,
                    'name' => $basicInfo->fullName,
                    'qty' => $qty,
                    'price' => $price,
                    'options' => [
                        'image' => $image ? $image->image_one : '',
                        'member_id' => $member->id
                    ]
                ]);
                Toastr::success('তালিকায় যুক্ত হয়েছে ');
            }
        }

        $data = Cart::instance('wishlist')->content();
        return view('frontEnd.download.wishlist', compact('data'));
    }
    public function wishlist_count()
    {
        return view('frontEnd.layouts.ajax.wishcount');
    }

    public function wishlist_remove(Request $request)
    {
        Cart::instance('wishlist')->update($request->member_id, 0);
        Toastr::error('তালিকা থেকে বাতিল হয়েছে ');
        return redirect()->route('wishlist');
    }

    public function payment()
    {
        if (Cart::instance('wishlist')->count() < 1) {
            Toastr::error('আপনার তালিকা খালি আছে ');
            return back();
        }
        $data = Cart::instance('payment')->content();
        return view('frontEnd.download.payment', compact('data'));
    }

    public function payment_confirm()
    {
        $member = Member::where('id', Auth::guard('member')->user()->id)->select('fullName', 'phoneNumber', 'id', 'publish')->first();
        if ($member->publish == 0) {
            return redirect()->back();
        } else {
            $basicInfo = BasicInfo::where('member_id', Auth::guard('member')->user()->id)->first();
            if (!$basicInfo) {
                return redirect()->route('member.editprofile');
            }
            if (Cart::instance('wishlist')->count() <= 0) {
                Toastr::error('আপনার তালিকা খালি আছে ');
                return redirect()->back();
            }

            $member = Member::where('id', Auth::guard('member')->user()->id)->select('fullName', 'phoneNumber', 'id')->first();

            $basicInformation = BasicInfo::where('member_id', Auth::guard('member')->user()->id)->select('member_id', 'district_id', 'upazila_id', 'present_address')->with('district', 'upazila')->first();
            $subtotal = Cart::instance('wishlist')->subtotal();
            $subtotal = str_replace(',', '', $subtotal);
            $subtotal = str_replace('.00', '', $subtotal);
            $info = array(
                'currency' => "BDT",
                'amount' => $subtotal,
                'order_id' => uniqid(),
                'discsount_amount' => 0,
                'disc_percent' => 0,
                'client_ip' => "https://borbou.com.bd/",
                'customer_name' => $member->fullName,
                'customer_phone' => $member->phoneNumber,
                'email' => "customer@shuvokaj.com",
                'customer_address' => $basicInformation->present_address,
                'customer_city' => $basicInformation->district->title ?? 'Dinajpur',
                'customer_state' => $basicInformation->upazila->title ?? 'Dinajpur',
                'customer_postcode' => "1212",
                'customer_country' => "BD",
                'value1' => "visitor_payment",
            );
            $shurjopay_service = new ShurjopayController();
            return $shurjopay_service->checkout($info);
        }
    }

    public function download()
    {
        $basicInformation = BasicInfo::where('member_id', Auth::guard('member')->user()->id)->first();
        if (!$basicInformation) {
            return redirect()->route('member.basicinfo');
        }
        $datas = OrderDetails::where(['status' => 1, 'visitor_id' => Auth::guard('member')->user()->id])->get();
        return view('frontEnd.download.download', compact('datas'));
    }

    public function download_pdf(Request $request)
    {
        $member = Member::where(['id' => $request->member_id, 'status' => '1'])->first();
        $basicInfo = BasicInfo::latest()->with('maritalstatus', 'religion', 'country', 'nationality', 'profileby', 'recidency')->where('member_id', $member->id)->first();
        $pdf_image = Memberimage::where('member_id', $member->id)->first();
        $career = EducationCareer::latest()->where('member_id', $member->id)->with('working', 'profession')->firstOrfail();
        $educations = EducationValue::orderBy('degree_id', 'desc')->latest()->where('member_id', $member->id)->with('degree', 'education')->get();
        $family = FamilyLocation::latest()->where('member_id', $member->id)->first();
        $aboutmyself = AboutMyself::latest()->where('member_id', $member->id)->first();
        $logo = GeneralSetting::first();
        return view('frontEnd.download.pdf', compact('member', 'basicInfo', 'pdf_images', 'career', 'educations', 'family', 'logo', 'aboutmyself'));
    }

    public function biodata_details(Request $request)
    {
        $id = $request->id;
        $member = Member::where(['id' => $id, 'status' => '1', 'publish' => 1])->first();
        if(!$member) {
            Toastr::error('মেম্বার এর ডাটা প্রাইভেট করা আছে।');
            return redirect()->back();
        }
        $aboutmyself = AboutMyself::latest()->where('member_id', $id)->first();
        $logo = GeneralSetting::first();
        $basicInfo = BasicInfo::where('member_id', $member->id)->orderBy('id', 'ASC')->firstOrfail();
        $image = Memberimage::where('member_id', $member->id)->first();
        $career = EducationCareer::where('member_id', $member->id)->with('working', 'profession')->firstOrfail();
        $educations = EducationValue::orderBy('degree_id', 'desc')->where('member_id', $member->id)->with('degree', 'degree.educationcat', 'education')->get();
        // return $educations;
        $familylocation = FamilyLocation::latest()->where('member_id', $member->id)->first();
        return view('frontEnd.download.biodata', compact('member', 'basicInfo', 'career', 'educations', 'logo', 'aboutmyself',  'image', 'career', 'educations', 'familylocation'));
    }

    public function delete_pdf(Request $request)
    {
        $order = OrderDetails::find($request->id);
        $order->delete();
        Toastr::error('তালিকা থেকে বাতিল হয়েছে');
        return redirect()->back();
    }
}
