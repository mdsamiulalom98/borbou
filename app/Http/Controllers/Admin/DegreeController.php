<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Degree;
use Toastr;

class DegreeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:degree-list|degree-create|degree-edit|degree-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:degree-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:degree-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:degree-delete', ['only' => ['destroy']]);
    }

    public function parent(Request $request)
    {
        $show_data = Degree::where('parent_id', 0)->orderBy('id', 'ASC')->get();
        return view('backEnd.degree.index', compact('show_data'));
    }

    public function index(Request $request)
    {
        $show_data = Degree::where('status', 1)->orderBy('id', 'DESC')->with('educationcat')->get();
        return view('backEnd.degree.index', compact('show_data'));
    }
    public function create()
    {
        $parentdegrees = Degree::where('parent_id', 0)->get();
        return view('backEnd.degree.create', compact('parentdegrees'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);        

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);
        $input['status'] = $request->status?1:0;
        // dd($input);
        Degree::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('degree.index');
    }

    public function edit($id)
    {
        $edit_data = Degree::find($id);
        return view('backEnd.degree.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $update_data = Degree::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('degree.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Degree::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Degree::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Degree::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

    public function slugify (Request $request)
    {
        $degrees = Degree::all();
        // return $degrees;
        foreach($degrees as $degree){
            $degreesave = Degree::find($degree->id);
            $degreesave->slug = strtolower(preg_replace('/\s+/', '-', $degree->title));
            $degreesave->save();
            // return $degreesave;
            
        }
        return "slugify done";
    }
}