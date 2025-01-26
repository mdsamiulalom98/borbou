<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Toastr;
use Session;

class LocationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:location-division|location-district|location-upazila|location-edit', ['only' => ['index', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $show_data = Location::orderBy('id', 'ASC')->get();
        return view('backEnd.location.index', compact('show_data'));
    }

    public function division()
    {
        $show_data = Location::orderBy('division_id', 'ASC')->orderBy('id', 'ASC')->get();
        $data_divisions = Location::where('district_id', 0)->where('division_id', 0)->limit(8)->get();
        return view('backEnd.location.division', compact('show_data', 'data_divisions'));
    }

    public function district()
    {
        $show_data = Location::where('district_id', '!=', 0)->where('division_id', '!=', 0)->orderBy('id', 'ASC')->get();
        $data_districts = Location::where('district_id', 0)->where('division_id', '!=', 0)->get();
        return view('backEnd.location.district', compact('show_data', 'data_districts'));
    }
    public function create()
    {
        $divisions = Location::where('division_id',0)->orderBy('id', 'ASC')->get();
        return view('backEnd.location.create',compact('divisions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        
        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);
        Location::create($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('location.index');
    }
    public function edit($id)
    {
        $edit_data = Location::find($id);
        $divisions = Location::where('division_id',0)->orderBy('id', 'ASC')->get();
        $districts = Location::where('division_id',$edit_data->division_id)->orderBy('id', 'ASC')->get();
        return view('backEnd.location.edit', compact('edit_data','divisions','districts'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $update_data = Location::find($request->id);
        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('location.index');
    }

    public function assign_division(Request $request)
    {
        $items = $request->item;
        $next_id = $request->division_id + 1;
        // return $next_id;
        Session::put('next_id_2', $next_id);
        foreach($items as $item){
            $item         =   Location::find($item);
            $item->division_id =   $request->division_id;
            $item->save();
        } 
        Toastr::success('Success','Data updated successfully');
        return redirect()->back();
    }

    public function assign_district(Request $request)
    {
        $items = $request->item;
        $division_id = Location::where('id', $request->district_id)->first()->division_id;
        $district_id = $request->district_id;
        $next_id = $district_id + 1;
        // return $next_id;
        Session::put('next_id', $next_id);
        foreach($items as $item){
            $item         =   Location::find($item);
            $item->district_id =   $request->district_id;
            $item->division_id =   $division_id;
            $item->save();
        } 
        Toastr::success('Success','Data updated successfully');
        return redirect()->back();
    }

    public function slugify (Request $request)
    {
        $locations = Location::all();
        // return $locations;
        foreach($locations as $location){
            $locationsave = Location::find($location->id);
            $locationsave->slug = strtolower(preg_replace('/\s+/', '-', $location->title));
            $locationsave->save();
            // return $locationsave;
            
        }
        return "slugify done";
    }
}

