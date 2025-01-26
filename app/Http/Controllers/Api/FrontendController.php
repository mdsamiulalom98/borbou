<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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
use App\Models\Memberlanguage;
use App\Models\Memberimage;
use App\Models\EducationCareer;
use App\Models\EducationValue;
use App\Models\FamilyLocation;
use App\Models\CreatePage;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\PaymentDetails;

class FrontendController extends Controller
{
   public function members(Request $request)
    {
    
     
     $members = Member::where(['status' => 1, 'publish' => 1])->orderBy('id', 'DESC')->with('basicinfo:id,member_id,fullName,marital_status,religion_id,age,division_id,residency_id', 'basicinfo.maritalstatus','memberimage','basicinfo.religion','careerinfo.profession', 'basicinfo.division', 'basicinfo.recidency')->select('id','fullName','phoneNumber','image','gender');
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
        $members = $members->paginate(20);
        // $members = $members->limit(18)->get();
     
     
      return response()->json([
          'members' =>  $members,
      ]);
    }
    
    
    public function singleDetails($member_id)
    {
        // $member = Member::where(['id' => $member_id, 'status' => '1', 'publish' => 1])->first();
        $member =  $members = Member::where(['id' => $member_id, 'status' => '1', 'publish' => 1])->orderBy('id', 'DESC')->with('basicinfo:id,member_id,fullName,marital_status,religion_id,age,division_id,residency_id', 'basicinfo.maritalstatus','memberimage','basicinfo.religion','careerinfo.profession', 'basicinfo.division', 'basicinfo.recidency')->select('id','fullName','phoneNumber','image','gender')->first();
        
        $basicInfo = BasicInfo::where('member_id', $member->id)->orderBy('id', 'ASC')->firstOrfail();
        $image = Memberimage::where('member_id', $member->id)->first();
        $career = EducationCareer::where('member_id', $member->id)->with('working', 'profession')->firstOrfail();
        $educations = EducationValue::orderBy('degree_id', 'desc')->where('member_id', $member->id)->with('degree', 'degree.educationcat', 'education')->get();
        $familylocation = FamilyLocation::latest()->where('member_id', $member->id)->first();
        return response()->json([
            'status'=> 'success',
            'member'=>$member,
            'basicInfo'=>$basicInfo,
            'image'=>$image,
            'career'=>$career,
            'educations'=>$educations,
            'familylocation'=>$familylocation,
        ]);
    }
    
    public function register()
    {
        $edulevels = Degree::where(['parent_id' => 0, 'status' => 1])->select('id','title','parent_id')->get();
        $maritalstatuses = MaritalStatus::where('status', 1)->select('id','title')->get();
        $bloodgroups = BloodGroup::where('status', 1)->select('id','title')->get();
        $complexions = Complexion::where('status', 1)->select('id','title')->get();
        $professions = Profession::where('status', 1)->orderBy('id', 'asc')->select('id','title')->get();
        $workings = Working::where('status', 1)->orderBy('id', 'asc')->select('id','title')->get();
        $nationalities = Country::where('status', 1)->orderBy('id', 'asc')->select('id','title')->get();
        $monthnames = Monthname::orderBy('id', 'asc')->select('id','title')->get();
        $religions = Religion::where('status', 1)->orderBy('id', 'asc')->select('id','title')->get();
        $locations = Location::orderBy('serial', 'asc')->where(['division_id' => 0, 'district_id' => 0])->select('id','title','district_id','division_id','serial')->get();
        return response()->json([
           'edulevels'=>$edulevels,
           'maritalstatuses'=>$maritalstatuses,
           'bloodgroups'=>$bloodgroups,
           'complexions'=>$complexions,
           'professions'=>$professions,
           'workings'=>$workings,
           'locations'=>$locations,
           'nationalities'=>$nationalities,
           'monthnames'=>$monthnames,
           'religions'=>$religions,
        ]);

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
    
    public function getDivision() {
        $data = Location::where(['district_id' => 0, 'division_id' => 0])->orderBy('serial', 'asc')->get();
        return response()->json([
            'status'=>'status',
            'data'=>$data,
        ]);
    }
    
    public function getDistricts(Request $request)
    {
            
            $districts = Location::where(['district_id' => 0, 'division_id' => $request->division])->whereNot('division_id', 0)->orderBy('title', 'asc')->get();
            return response()->json($districts);
    }

    public function getUpazilas(Request $request)
    {
         $upazilas = Location::where('district_id', $request->district)->whereNot('division_id', 0)->whereNot('district_id', 0)->get();
         return response()->json($upazilas);
    }
    
    public function page()
    {
        $data = CreatePage::where('status', 1)->select('id','name','slug')->get();
        return response()->json([
            'status'=>'success',
            'data'=>$data,
        ]);
    }
    
    public function pageDetails($slug)
    {
        $data = CreatePage::where('slug', $slug)->firstOrFail();
        return response()->json([
            'status'=>'success',
            'data'=>$data,
            ]);
    }

}
