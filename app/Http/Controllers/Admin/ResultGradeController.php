<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resultgrade;
use Toastr;

class ResultGradeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:resultgrade-list|resultgrade-create|resultgrade-edit|resultgrade-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:resultgrade-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:resultgrade-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:resultgrade-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Resultgrade::orderBy('id', 'ASC')->get();
        return view('backEnd.resultgrade.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.resultgrade.create');
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
        Resultgrade::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('resultgrade.index');
    }

    public function edit($id)
    {
        $edit_data = Resultgrade::find($id);
        return view('backEnd.resultgrade.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Resultgrade::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('resultgrade.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Resultgrade::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Resultgrade::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Resultgrade::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}

