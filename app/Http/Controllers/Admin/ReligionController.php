<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Religion;
use Toastr;

class ReligionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:religion-list|religion-create|religion-edit|religion-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:religion-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:religion-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:religion-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Religion::orderBy('id', 'ASC')->get();
        return view('backEnd.religion.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.religion.create');
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
        Religion::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('religion.index');
    }

    public function edit($id)
    {
        $edit_data = Religion::find($id);
        return view('backEnd.religion.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Religion::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('religion.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Religion::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Religion::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Religion::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
