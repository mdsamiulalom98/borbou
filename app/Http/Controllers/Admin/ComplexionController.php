<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complexion;
use Toastr;

class ComplexionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:complexion-list|complexion-create|complexion-edit|complexion-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:complexion-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:complexion-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:complexion-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Complexion::orderBy('id', 'ASC')->get();
        return view('backEnd.complexion.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.complexion.create');
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
        Complexion::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('complexion.index');
    }

    public function edit($id)
    {
        $edit_data = Complexion::find($id);
        return view('backEnd.complexion.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Complexion::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('complexion.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Complexion::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Complexion::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Complexion::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}