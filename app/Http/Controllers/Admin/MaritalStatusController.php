<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use Toastr;

class MaritalStatusController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:maritalstatus-list|maritalstatus-create|maritalstatus-edit|maritalstatus-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:maritalstatus-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:maritalstatus-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:maritalstatus-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = MaritalStatus::orderBy('id', 'ASC')->get();
        return view('backEnd.maritalstatus.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.maritalstatus.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);        

        $input = $request->all();
        $input = $request->except('_token');
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);
        $input['status'] = $request->status?1:0;
        // dd($input);
        MaritalStatus::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('maritalstatus.index');
    }

    public function edit($id)
    {
        $edit_data = MaritalStatus::find($id);
        return view('backEnd.maritalstatus.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = MaritalStatus::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('maritalstatus.index');
    }

    public function inactive(Request $request)
    {
        $inactive = MaritalStatus::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = MaritalStatus::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = MaritalStatus::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
