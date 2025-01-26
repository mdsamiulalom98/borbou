<?php

namespace App\Http\Controllers\FrontEnd;

use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Religion;
use App\Models\Monthname;
use App\Models\MaritalStatus;
use App\Models\Profession;
use App\Models\BloodGroup;
use App\Models\Complexion;
use App\Models\SuccessStory;
use App\Models\Member;
use App\Models\Location;
use App\Models\Country;
use App\Models\Working;
use App\Models\Degree;
use App\Models\BasicInfo;
use App\Models\Memberimage;
use App\Models\EducationCareer;
use App\Models\EducationValue;
use App\Models\FamilyLocation;
use App\Models\CreatePage;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\PaymentDetails;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontEndController extends Controller
{
    public function home(Request $request)
    {
        $religions = Religion::where('status', 1)->get();
        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        $allsuccess = SuccessStory::where('status', 1)->get();
        $male_members = Member::where(['status' => 1, 'gender' => 1, 'premium' => 1, 'publish' => 1])->with('basicinfo', 'careerinfo')->latest()->limit(10)->get();
        $female_members = Member::where(['status' => 1, 'gender' => 2, 'premium' => 1, 'publish' => 1])->with('basicinfo', 'careerinfo')->latest()->limit(10)->get();
        $date = Carbon::now();
        $premium_members = Member::where(['premium' => 1])->where('premium_date', '<=', $date)->get();
        foreach ($premium_members as $premium_member) {
            $premium_member = Member::find($premium_member->id);
            $premium_member->premium = 0;
            $premium_member->save();
        }

        $edulevels = Degree::where('parent_id', 0)->get();
        $professions = Profession::where(['status' => 1])->get();
        $workings = Working::get();
        $countries = Country::get();
        $locations = Location::where(['district_id' => 0, 'division_id' => 0])->orderBy('serial', 'asc')->get();
        $districts = Location::where(['district_id' => 0, 'division_id' => $request->division])->whereNot('division_id', 0)->orderBy('title', 'asc')->get();
        $upazilas = Location::where('district_id', $request->district)->get();
        $members = Member::where(['status' => 1, 'publish' => 1])->orderBy('id', 'DESC')->with('basicinfo');
        if ($request->gender) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('gender', $request->gender);
            });
        }

        if ($request->from && $request->to) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->whereBetween('age', [$request->from, $request->to]);
            });
        }

        // if($request->to){
        //    $members = $members->whereHas('basicinfo', function($query) use ($request) {
        //    $query->where('age',  $request->nationality);
        //  });
        // }

        if ($request->marital_status) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('marital_status', $request->marital_status);
            });
        }
        if ($request->religion) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('religion_id', $request->religion);
            });
        }
        if ($request->degree) {
            $members = $members->whereHas('educationinfo', function ($query) use ($request) {
                $query->where('education_id', $request->degree);
            });
        }
        if ($request->profession) {
            $members = $members->whereHas('careerinfo', function ($query) use ($request) {
                $query->where('profession_id', $request->profession);
            });
        }
        if ($request->working) {
            $members = $members->whereHas('careerinfo', function ($query) use ($request) {
                $query->where('working_id', $request->working);
            });
        }

        if ($request->residency) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('residency_id', $request->residency);
            });
        }
        if ($request->citizenship) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('country_id', $request->citizenship);
            });
        }

        if ($request->division) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('division_id', '=', $request->division);
            });
        }
        if ($request->district) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('district_id', '=', $request->district);
            });
        }
        if ($request->upazila) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('upazila_id', $request->upazila);
            });
        }
        if ($request->member_id) {
            $members = $members->where('id', $request->member_id);
        }
        $members = $members->limit(18)->get();
        // return  $members;
        return view('frontEnd.layouts.index', compact('religions', 'maritalstatuses', 'allsuccess', 'male_members', 'female_members', 'edulevels', 'professions', 'workings', 'countries', 'locations', 'districts', 'upazilas', 'members'));
    }

    public function searchPage(Request $request)
    {
        return redirect()->route('home');

        $members = Member::where(['status' => 1, 'publish' => 1])->orderBy('id', 'DESC')->with('basicinfo');

        if ($request->gender) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('gender', $request->gender);
            });
        }

        if ($request->from && $request->to) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->whereBetween('age', [$request->from, $request->to]);
            });
        }


        // if($request->to){
        //    $members = $members->whereHas('basicinfo', function($query) use ($request) {
        //    $query->where('age',  $request->nationality);
        //  });
        // }

        if ($request->marital_status) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('marital_status', $request->marital_status);
            });
        }
        if ($request->religion) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('religion_id', $request->religion);
            });
        }
        if ($request->degree) {
            $members = $members->whereHas('educationinfo', function ($query) use ($request) {
                $query->where('education_id', $request->degree);
            });
        }
        if ($request->profession) {
            $members = $members->whereHas('careerinfo', function ($query) use ($request) {
                $query->where('profession_id', $request->profession);
            });
        }
        if ($request->working) {
            $members = $members->whereHas('careerinfo', function ($query) use ($request) {
                $query->where('working_id', $request->working);
            });
        }

        if ($request->residency) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('residency_id', $request->residency);
            });
        }
        if ($request->citizenship) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('country_id', $request->citizenship);
            });
        }

        if ($request->division) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('division_id', '=', $request->division);
            });
        }
        if ($request->district) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('district_id', '=', $request->district);
            });
        }
        if ($request->upazila) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('upazila_id', $request->upazila);
            });
        }
        if ($request->member_id) {
            $members = $members->where('id', 'LIKE', "%$request->member_id%");
        }

        $upazilas = Location::where('district_id', $request->district)->get();

        $members = $members->paginate(9);
        // return $members;
        $religions = Religion::get();
        $maritalstatuses = MaritalStatus::get();
        $locations = Location::where(['district_id' => 0, 'division_id' => 0])->orderBy('serial', 'asc')->get();
        $districts = Location::where(['district_id' => 0])->whereNot('division_id', 0)->orderBy('title', 'asc')->get();
        $professions = Profession::where(['status' => 1])->get();
        $countries = Country::get();
        $workings = Working::get();
        $edulevels = Degree::where('parent_id', 0)->get();
        return view('frontEnd.layouts.pages.searchpage', compact('members', 'religions', 'maritalstatuses', 'locations', 'districts', 'countries', 'workings', 'edulevels', 'professions', 'upazilas'));
    }

    public function singleDetails($member_id)
    {
        $member = Member::where(['id' => $member_id, 'status' => '1', 'publish' => 1])->first();
        $basicInfo = BasicInfo::where('member_id', $member->id)->orderBy('id', 'ASC')->firstOrfail();
        $image = Memberimage::where('member_id', $member->id)->first();
        $career = EducationCareer::where('member_id', $member->id)->with('working', 'profession')->firstOrfail();

        $educations = EducationValue::orderBy('degree_id', 'desc')->where('member_id', $member->id)->with('degree', 'degree.educationcat', 'education')->get();
        // return $educations;
        $familylocation = FamilyLocation::latest()->where('member_id', $member->id)->first();
        return view('frontEnd.layouts.pages.singledetails', compact('member', 'basicInfo', 'image', 'career', 'educations', 'familylocation'));
    }

    public function login()
    {
        return view('frontEnd.member.login');
    }

    public function register()
    {
        $edulevels = Degree::where(['parent_id' => 0, 'status' => 1])->get();
        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        $bloodgroups = BloodGroup::where('status', 1)->get();
        $complexions = Complexion::where('status', 1)->get();
        $professions = Profession::where('status', 1)->orderBy('id', 'asc')->get();
        $workings = Working::where('status', 1)->orderBy('id', 'asc')->get();
        $nationalities = Country::where('status', 1)->orderBy('id', 'asc')->get();
        $monthnames = Monthname::orderBy('id', 'asc')->get();
        $religions = Religion::where('status', 1)->orderBy('id', 'asc')->get();
        $locations = Location::orderBy('serial', 'asc')->where(['division_id' => 0, 'district_id' => 0])->get();
        return view('frontEnd.member.register', compact('edulevels', 'maritalstatuses', 'bloodgroups', 'complexions', 'professions', 'workings', 'locations', 'nationalities', 'monthnames', 'religions'));
    }
    
    public function registermissingpage()
    {
        $edulevels = Degree::where(['parent_id' => 0, 'status' => 1])->get();
        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        $bloodgroups = BloodGroup::where('status', 1)->get();
        $complexions = Complexion::where('status', 1)->get();
        $professions = Profession::where('status', 1)->orderBy('id', 'asc')->get();
        $workings = Working::where('status', 1)->orderBy('id', 'asc')->get();
        $nationalities = Country::where('status', 1)->orderBy('id', 'asc')->get();
        $monthnames = Monthname::orderBy('id', 'asc')->get();
        $religions = Religion::where('status', 1)->orderBy('id', 'asc')->get();
        $locations = Location::orderBy('serial', 'asc')->where(['division_id' => 0, 'district_id' => 0])->get();
        return view('frontEnd.member.registermissing', compact('edulevels', 'maritalstatuses', 'bloodgroups', 'complexions', 'professions', 'workings', 'locations', 'nationalities', 'monthnames', 'religions'));
    }

    public function contact()
    {
        return view('frontEnd.layouts.pages.contact');
    }

    public function contactStore()
    {
        return redirect()->back();
    }

    public function page($slug)
    {
        $page = CreatePage::where('slug', $slug)->firstOrFail();
        return view('frontEnd.layouts.pages.page', compact('page'));
    }

    public function payment_success(Request $request)
    {
        $order_id = $request->order_id;
        $shurjopay_service = new ShurjopayController();
        $json = $shurjopay_service->verify($order_id);
        $data = json_decode($json);

        if ($data[0]->sp_code != 1000) {
            Toastr::error('আপনার পেমেন্ট সফল হয়নি।');
            if ($data[0]->value1 == 'visitor_payment') {
                return redirect()->route('member.editprofile');
            } else {
                return redirect()->route('member.editprofile');
            }
        }

        if ($data[0]->value1 == 'visitor_payment') {
            $visitor                 = Member::find(Auth::guard('member')->user()->id);
            // order data save
            $order                   = new Order();
            $order->invoice_id       = $data[0]->order_id;
            $order->amount           = $data[0]->amount;
            $order->visitor_id       = Auth::guard('member')->user()->id;
            $order->order_status     = $data[0]->bank_status;
            $order->save();

            // payment data save
            $payment                 = new Payment();
            $payment->order_id       = $order->id;
            $payment->visitor_id     = Auth::guard('member')->user()->id;
            $payment->payment_method = 'shurjopay';
            $payment->amount         = $order->amount;
            $payment->trx_id         = $data[0]->bank_trx_id;
            $payment->sender_number  = $data[0]->phone_no;
            $payment->payment_status = 'paid';
            $payment->save();
            // order details data save
            foreach (Cart::instance('wishlist')->content() as $cart) {
                $order_details                   =   new OrderDetails();
                $order_details->order_id         =   $order->id;
                $order_details->member_id        =   $cart->options->member_id;
                $order_details->visitor_id       =   Auth::guard('member')->user()->id;
                $order_details->name             =   $cart->name;
                $order_details->amount           =   $cart->price;
                $order_details->qty              =   $cart->qty;
                $order_details->status           =   1;
                $order_details->save();
            }
            Cart::instance('wishlist')->destroy();
            Toastr::error('আপনার পেমেন্ট সফল হয়েছে');
            return redirect()->route('biodata.download');
        }

        if ($data[0]->value1 == 'member_payment') {
            $date = $data[0]->value3;
            $member = Member::find(Auth::guard('member')->user()->id);
            $member->premium = 1;
            $member->premium_date = Carbon::now()->addDays($date);
            $member->save();
            Toastr::error('আপনার পেমেন্ট সফল হয়েছে');
            return redirect()->route('member.editprofile');
        }

        if ($data[0]->value1 == 'member_publish') {
            $date = $data[0]->value3;
            $member = Member::find(Auth::guard('member')->user()->id);
            $member->publish = 1;
            $member->premium_date = Carbon::now()->addDays($date);
            $member->save();
            // dd($data[0]);
            // payment details save
            $payment_details = new PaymentDetails();
            $payment_details->member_id = Auth::guard('member')->user()->id;
            $payment_details->transaction_id = $data[0]->bank_trx_id;
            $payment_details->amount = $data[0]->amount;
            $payment_details->save();
            
            Toastr::error('আপনার পেমেন্ট সফল হয়েছে');
            return redirect()->route('member.editprofile');
        }
        Toastr::error('আপনার পেমেন্ট সফল হয়নি।');
        return redirect()->route('home');
    }

    public function payment_cancel(Request $request)
    {
        $order_id = $request->order_id;
        $shurjopay_service = new ShurjopayController();
        $json = $shurjopay_service->verify($order_id);
        $data = json_decode($json);

        Toastr::error('আপনার পেমেন্ট সফল হয়নি।');
        if ($data[0]->sp_code != 1000) {
            if ($data[0]->value1 == 'visitor_payment') {
                return redirect()->route('member.editprofile');
            } else {
                return redirect()->route('member.editprofile');
            }
        }
    }

    public function visitorcontact(Request $request)
    {

        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'cont_message' => $request->cont_message,
        );
        // return $data;
        $send = Mail::send('frontEnd.layouts.emails.contact', $data, function ($textmsg) use ($data) {
            $textmsg->from('info@shuvokaj.com');
            $textmsg->to('info@shuvokaj.com');
            $textmsg->subject($data['subject']);
        });

        Toastr::success('ধন্যবাদ, আপনার মেসেজ সফলভাবে প্রেরিত হয়েছে।');
        return redirect()->back();
    }

    public function loadMorePosts(Request $request)
    {
        $page = $request->page;
        $perPage = 9;

        $members = Member::where(['status' => 1, 'publish' => 1])
            ->orderBy('id', 'DESC')
            ->with('basicinfo');

        if ($request->gender) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('gender', $request->gender);
            });
        }

        if ($request->from && $request->to) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->whereBetween('age', [$request->from, $request->to]);
            });
        }

        // if($request->to){
        //    $members = $members->whereHas('basicinfo', function($query) use ($request) {
        //    $query->where('age',  $request->nationality);
        //  });
        // }

        if ($request->marital_status) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('marital_status', $request->marital_status);
            });
        }
        if ($request->religion) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('religion_id', $request->religion);
            });
        }
        if ($request->degree) {
            $members = $members->whereHas('educationinfo', function ($query) use ($request) {
                $query->where('education_id', $request->degree);
            });
        }
        if ($request->profession) {
            $members = $members->whereHas('careerinfo', function ($query) use ($request) {
                $query->where('profession_id', $request->profession);
            });
        }
        if ($request->working) {
            $members = $members->whereHas('careerinfo', function ($query) use ($request) {
                $query->where('working_id', $request->working);
            });
        }

        if ($request->residency) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('residency_id', $request->residency);
            });
        }
        if ($request->citizenship) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('country_id', $request->citizenship);
            });
        }

        if ($request->division) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('division_id', '=', $request->division);
            });
        }
        if ($request->district) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('district_id', '=', $request->district);
            });
        }
        if ($request->upazila) {
            $members = $members->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('upazila_id', $request->upazila);
            });
        }
        if ($request->member_id) {
            $members = $members->where('id', $request->member_id);
        }

        $members = $members->skip($page * $perPage)
            ->take($perPage)
            ->get();

        return view('frontEnd.layouts.ajax.loadmorepage', compact('members'))->render();
    }

    public function navigation_change()
    {
        return view('frontEnd.layouts.navigation');
    }
    
    public function livesearch(Request $request){
        $members = Member::select('id', 'fullName')
            ->where(['status'=>1, 'publish'=> 1])
            ->with('memberimage');
        if ($request->keyword) {
            $members = $members->where('id', 'LIKE', '%' . $request->keyword . "%");
        }

        $members = $members->limit(5)->get();

        if (empty($request->keyword)) {
            $members = [];
        }
        return view('frontEnd.layouts.ajax.search', compact('members'));
    }
}
