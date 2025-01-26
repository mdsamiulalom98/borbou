<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Height;
use Toastr;

class HeightController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:height-list|height-create|height-edit|height-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:height-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:height-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:height-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Height::orderBy('id', 'ASC')->get();
        return view('backEnd.height.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.height.create');
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
        Height::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('height.index');
    }

    public function edit($id)
    {
        $edit_data = Height::find($id);
        return view('backEnd.height.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Height::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('height.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Height::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Height::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Height::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

    public function slugify (Request $request)
    {
        $heights = Height::all();
        // return $heights;
        foreach($heights as $height){
            $heightsave = Height::find($height->id);
            $heightsave->slug = strtolower(preg_replace('/\s+/', '-', $height->title));
            $heightsave->save();
            // return $heightsave;
            
        }
        return "slugify done";
    }
}
