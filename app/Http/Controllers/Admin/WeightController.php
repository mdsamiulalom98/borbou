<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weight;
use Toastr;

class WeightController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:weight-list|weight-create|weight-edit|weight-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:weight-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:weight-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:weight-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Weight::orderBy('id', 'ASC')->get();
        return view('backEnd.weight.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.weight.create');
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
        Weight::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('weight.index');
    }

    public function edit($id)
    {
        $edit_data = Weight::find($id);
        return view('backEnd.weight.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Weight::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('weight.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Weight::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Weight::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Weight::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
