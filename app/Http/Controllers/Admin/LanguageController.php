<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Toastr;

class LanguageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:language-list|language-create|language-edit|language-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:language-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:language-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:language-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = Language::orderBy('id', 'ASC')->get();
        return view('backEnd.language.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.language.create');
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
        Language::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('language.index');
    }

    public function edit($id)
    {
        $edit_data = Language::find($id);
        return view('backEnd.language.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = Language::find($request->id);

        $input = $request->all();
        $input['slug'] = preg_replace('/\s+/', '-', $request->title);        
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('language.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Language::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = Language::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Language::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

    public function slugify (Request $request)
    {
        $languages = Language::all();
        // return $languages;
        foreach($languages as $language){
            $languagesave = Language::find($language->id);
            $languagesave->slug = strtolower(preg_replace('/\s+/', '-', $language->title));
            $languagesave->save();
            // return $languagesave;
            
        }
        return "slugify done";
    }
}
