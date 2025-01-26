<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Working;
use Toastr;

class WorkingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:working-list|working-create|working-edit|working-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:working-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:working-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:working-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Working::orderBy('id', 'ASC')->get();
        return view('backEnd.working.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.working.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);        

        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['status'] = $request->status?1:0;
        // dd($input);
        Working::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('working.index');
    }

    public function edit($id)
    {
        $edit_data = Working::find($id);
        return view('backEnd.working.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Working::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('working.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Working::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Working::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Working::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
