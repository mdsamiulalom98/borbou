<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;
use Toastr;

class ProfessionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:profession-list|profession-create|profession-edit|profession-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:profession-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:profession-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:profession-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Profession::orderBy('id', 'ASC')->get();
        return view('backEnd.profession.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.profession.create');
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
        Profession::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('profession.index');
    }

    public function edit($id)
    {
        $edit_data = Profession::find($id);
        return view('backEnd.profession.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Profession::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('profession.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Profession::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Profession::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Profession::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

    public function slugify (Request $request)
    {
        $professions = Profession::all();
        // return $professions;
        foreach($professions as $profession){
            $professionsave = Profession::find($profession->id);
            $professionsave->slug = strtolower(preg_replace('/\s+/', '-', $profession->title));
            $professionsave->save();
            // return $professionsave;
            
        }
        return "slugify done";
    }
}
