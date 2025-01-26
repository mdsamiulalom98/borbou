<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use App\Models\Location;
use App\Models\Religion;
use App\Models\Degree;
use App\Models\Profession;
use App\Models\Country;
use App\Models\Member;
use App\Models\Working;
use App\Models\BasicInfo;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use DateTime;

class MemberManageController extends Controller
{
    public function index(Request $request)
    {
        $show_data = Member::latest();
        $basicinfos = BasicInfo::orderBy('id', 'DESC')->select('id', 'member_id', 'dob', 'age')->get();

        if ($request->start_date && $request->end_date) {
            $show_data = $show_data->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        if ($request->gender) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('gender', $request->gender);
            });
        }
        if ($request->status != null) {
            $show_data = $show_data->where('status', $request->status == 1 ? 1 : '0');
        }
        // return $request->all();
        if ($request->marital_status != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('marital_status', '=', $request->marital_status);
            });
        }
        if ($request->religion != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('religion_id', '=', $request->religion);
            });
        }
        if ($request->country != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('country_id', '=', $request->country);
            });
        }
        if ($request->division != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('division_id', '=', $request->division);
            });
        }
        if ($request->district != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('district_id', '=', $request->district);
            });
        }
        if ($request->upazila != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('upazila_id', '=', $request->upazila);
            });
        }
        if ($request->working != null) {
            $show_data = $show_data->whereHas('careerinfo', function ($query) use ($request) {
                return $query->where('working_id', '=', $request->working);
            });
        }
        if ($request->profession != null) {
            $show_data = $show_data->whereHas('careerinfo', function ($query) use ($request) {
                return $query->where('profession_id', '=', $request->profession);
            });
        }
        if ($request->degree != null) {
            $show_data = $show_data->whereHas('educationinfo', function ($query) use ($request) {
                return $query->where('degree_id', '=', $request->degree);
            });
        }
        if ($request->education != null) {
            $show_data = $show_data->whereHas('educationinfo', function ($query) use ($request) {
                return $query->where('education_id', '=', $request->education);
            });
        }
        // return $request->all();

        $show_data = $show_data->where(['publish' => 1])->get();
        // return $show_data;

        $religions = Religion::get();
        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        $divisions = Location::orderBy('title', 'asc')->where(['division_id' => 0, 'district_id' => 0])->get();
        $districts = Location::orderBy('title', 'asc')->where(['division_id' => $request->division])->get();
        $upazilas = Location::orderBy('title', 'asc')->where(['district_id' => $request->district])->get();
        $edulevels = Degree::where('parent_id', 0)->get();
        $alldegrees = Degree::where('parent_id', '!=', 0)->get();
        $professions = Profession::where(['status' => 1])->get();
        $workings = Working::where(['status' => 1])->get();
        $countries = Country::get();
        
        $items = BasicInfo::all();
        foreach ($items as $item) {
            $dob = trim($item->dob); // Remove unnecessary spaces
            list($year, $month, $day) = explode('-', $dob);
            $cleanedDob = rtrim($dob, ' 0');
            
            $dateofbirth = "$year-$month-$day";
            $birthDateTime = new DateTime($dateofbirth);
            $todayDateTime = new DateTime();
            $ageInterval = $birthDateTime->diff($todayDateTime);
            $age =  $ageInterval->y;
            $item->age = $age;
            // $item->dob = $cleanedDob;
            $item->save();
        }

        return view('backEnd.member.index', compact('show_data', 'maritalstatuses', 'divisions', 'districts', 'upazilas', 'religions', 'edulevels', 'alldegrees', 'professions', 'countries', 'workings'));
    }
    
    public function birthday(Request $request)
    {
        $show_data = Member::with('basicinfo')->latest();
        //return $show_data;
        $basicinfos = BasicInfo::orderBy('id', 'DESC')->select('id', 'member_id', 'dob', 'age')->get();
        if ($request->start_date) {
            $show_data->whereHas('basicinfo', function ($query) use ($request) {
                $query->whereMonth('dob', Carbon::parse($request->start_date)->month)
                    ->whereDay('dob', Carbon::parse($request->start_date)->day);
            });
        }
        $show_data = $show_data->where(['publish' => 1])->get();

        return view('backEnd.member.birthday', compact('show_data'));
    }

    public function todaybirthday(Request $request)
    {
        $show_data = Member::with('basicinfo')->latest();
        $basicinfos = BasicInfo::orderBy('id', 'DESC')->select('id', 'member_id', 'dob', 'age')->get();
        $today = Carbon::today();
        $show_data->whereHas('basicinfo', function ($query) use ($today) {
            $query->whereMonth('dob', $today->month)
                ->whereDay('dob', $today->day);
        });
        $show_data = $show_data->where(['publish' => 1])->get();
        return view('backEnd.member.birthday', compact('show_data'));
    }

    public function new_member(Request $request)
    {
        $show_data = Member::where(['publish' => 0, 'deactivate' => 0])->select('id', 'fullName', 'phoneNumber', 'verifyToken', 'publish', 'status', 'created_at')->latest();
        if ($request->start_date && $request->end_date) {
            $show_data = $show_data->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        if ($request->gender) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('gender', $request->gender);
            });
        }
        if ($request->status != null) {
            $show_data = $show_data->where('status', $request->status == 1 ? 1 : '0');
        }
        if ($request->marital_status != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('marital_status', '=', $request->marital_status);
            });
        }
        if ($request->religion != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('religion_id', '=', $request->religion);
            });
        }
        if ($request->country != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('country_id', '=', $request->country);
            });
        }
        if ($request->division != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('division_id', '=', $request->division);
            });
        }
        if ($request->district != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('district_id', '=', $request->district);
            });
        }
        if ($request->upazila != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('upazila_id', '=', $request->upazila);
            });
        }
        if ($request->working != null) {
            $show_data = $show_data->whereHas('careerinfo', function ($query) use ($request) {
                return $query->where('working_id', '=', $request->working);
            });
        }
        if ($request->profession != null) {
            $show_data = $show_data->whereHas('careerinfo', function ($query) use ($request) {
                return $query->where('profession_id', '=', $request->profession);
            });
        }
        if ($request->degree != null) {
            $show_data = $show_data->whereHas('educationinfo', function ($query) use ($request) {
                return $query->where('degree_id', '=', $request->degree);
            });
        }
        if ($request->education != null) {
            $show_data = $show_data->whereHas('educationinfo', function ($query) use ($request) {
                return $query->where('education_id', '=', $request->education);
            });
        }
        $religions = Religion::get();
        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        $divisions = Location::orderBy('title', 'asc')->where(['division_id' => 0, 'district_id' => 0])->get();
        $districts = Location::orderBy('title', 'asc')->where(['division_id' => $request->division])->get();
        $upazilas = Location::orderBy('title', 'asc')->where(['district_id' => $request->district])->get();
        $edulevels = Degree::where('parent_id', 0)->get();
        $alldegrees = Degree::where('parent_id', '!=', 0)->get();
        $professions = Profession::where(['status' => 1])->get();
        $workings = Working::where(['status' => 1])->get();
        $countries = Country::get();

        $show_data = $show_data->get();
        return view('backEnd.member.new', compact('show_data', 'maritalstatuses', 'divisions', 'districts', 'upazilas', 'religions', 'edulevels', 'alldegrees', 'professions', 'countries', 'workings'));
    }

    public function old_member(Request $request)
    {
        $show_data = Member::where(['publish' => 0, 'status' => 0, 'deactivate' => 1])->select('id', 'fullName', 'phoneNumber', 'verifyToken', 'publish', 'status', 'created_at')->latest();

        if ($request->start_date && $request->end_date) {
            $show_data = $show_data->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        if ($request->gender) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                $query->where('gender', $request->gender);
            });
        }
        if ($request->status != null) {
            $show_data = $show_data->where('status', $request->status == 1 ? 1 : '0');
        }
        if ($request->marital_status != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('marital_status', '=', $request->marital_status);
            });
        }
        if ($request->religion != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('religion_id', '=', $request->religion);
            });
        }
        if ($request->country != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('country_id', '=', $request->country);
            });
        }
        if ($request->division != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('division_id', '=', $request->division);
            });
        }
        if ($request->district != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('district_id', '=', $request->district);
            });
        }
        if ($request->upazila != null) {
            $show_data = $show_data->whereHas('basicinfo', function ($query) use ($request) {
                return $query->where('upazila_id', '=', $request->upazila);
            });
        }
        if ($request->working != null) {
            $show_data = $show_data->whereHas('careerinfo', function ($query) use ($request) {
                return $query->where('working_id', '=', $request->working);
            });
        }
        if ($request->profession != null) {
            $show_data = $show_data->whereHas('careerinfo', function ($query) use ($request) {
                return $query->where('profession_id', '=', $request->profession);
            });
        }
        if ($request->degree != null) {
            $show_data = $show_data->whereHas('educationinfo', function ($query) use ($request) {
                return $query->where('degree_id', '=', $request->degree);
            });
        }
        if ($request->education != null) {
            $show_data = $show_data->whereHas('educationinfo', function ($query) use ($request) {
                return $query->where('education_id', '=', $request->education);
            });
        }

        $religions = Religion::get();
        $maritalstatuses = MaritalStatus::where('status', 1)->get();
        $divisions = Location::orderBy('title', 'asc')->where(['division_id' => 0, 'district_id' => 0])->get();
        $districts = Location::orderBy('title', 'asc')->where(['division_id' => $request->division])->get();
        $upazilas = Location::orderBy('title', 'asc')->where(['district_id' => $request->district])->get();
        $edulevels = Degree::where('parent_id', 0)->get();
        $alldegrees = Degree::where('parent_id', '!=', 0)->get();
        $professions = Profession::where(['status' => 1])->get();
        $workings = Working::where(['status' => 1])->get();
        $countries = Country::get();

        $show_data = $show_data->get();
        return view('backEnd.member.old', compact('show_data', 'maritalstatuses', 'divisions', 'districts', 'upazilas', 'religions', 'edulevels', 'alldegrees', 'professions', 'countries', 'workings'));
    }

    public function edit($id)
    {
        $edit_data = Member::find($id);
        return view('backEnd.member.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'required',
        ]);

        $input = $request->all();
        $update_data = Member::find($request->id);

        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('members.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Member::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->publish = 0;
        $inactive->deactivate = 1;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Member::find($request->hidden_id);
        $active->publish = 1;
        $active->status = 1;
        $active->deactivate = 0;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function adminlog(Request $request)
    {
        Auth::guard('member')->loginUsingId($request->member_id);
        return redirect()->route('member.editprofile');
    }
    public function profile(Request $request)
    {
        $profile = Member::find($request->id);
        $mydownload = OrderDetails::where(['visitor_id' => $profile->id])->orderBy('id', 'asc')->get();
        $downloaded = OrderDetails::where(['member_id' => $profile->id])->with('visitor')->orderBy('id', 'asc')->get();
        return view('backEnd.member.profile', compact('profile', 'mydownload', 'downloaded'));
    }

    public function download(Request $request)
    {
        $show_data = OrderDetails::with('visitor')->orderBy('id', 'DESC');
        if($request->start_date && $request->end_date){
            $show_data = $show_data->whereBetween('created_at',[$request->start_date, $request->end_date]);
        }
        $show_data = $show_data->get();
        return view('backEnd.download.index', compact('show_data'));
    }
}
