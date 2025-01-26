<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileBy;
use Toastr;

class ProfileByController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:profileby-list|profileby-create|profileby-edit|profileby-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:profileby-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:profileby-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:profileby-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = ProfileBy::orderBy('id', 'ASC')->get();
        return view('backEnd.profileby.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.profileby.create');
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
        ProfileBy::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('profileby.index');
    }

    public function edit($id)
    {
        $edit_data = ProfileBy::find($id);
        return view('backEnd.profileby.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = ProfileBy::find($request->id);

        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('profileby.index');
    }

    public function inactive(Request $request)
    {
        $inactive = ProfileBy::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = ProfileBy::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = ProfileBy::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
