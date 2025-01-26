<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use Toastr;

class BloodGroupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bloodgroup-list|bloodgroup-create|bloodgroup-edit|bloodgroup-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:bloodgroup-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bloodgroup-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:bloodgroup-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = BloodGroup::orderBy('id', 'ASC')->get();
        return view('backEnd.bloodgroup.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.bloodgroup.create');
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
        BloodGroup::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('bloodgroup.index');
    }

    public function edit($id)
    {
        $edit_data = BloodGroup::find($id);
        return view('backEnd.bloodgroup.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = BloodGroup::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('bloodgroup.index');
    }

    public function inactive(Request $request)
    {
        $inactive = BloodGroup::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = BloodGroup::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = BloodGroup::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}