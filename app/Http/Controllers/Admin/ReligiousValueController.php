<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReligiousValue;
use Toastr;

class ReligiousValueController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:religiousvalue-list|religiousvalue-create|religiousvalue-edit|religiousvalue-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:religiousvalue-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:religiousvalue-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:religiousvalue-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = ReligiousValue::orderBy('id', 'ASC')->get();
        return view('backEnd.religiousvalue.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.religiousvalue.create');
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
        ReligiousValue::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('religiousvalue.index');
    }

    public function edit($id)
    {
        $edit_data = ReligiousValue::find($id);
        return view('backEnd.religiousvalue.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = ReligiousValue::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('religiousvalue.index');
    }

    public function inactive(Request $request)
    {
        $inactive = ReligiousValue::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = ReligiousValue::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = ReligiousValue::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}

