<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuccessStory;
use Toastr;
use File;
use Image;

class SuccessController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:success-list|success-create|success-edit|success-delete', ['only' => ['index','store']]);
         $this->middleware('permission:success-create', ['only' => ['create','store']]);
         $this->middleware('permission:success-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:success-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = SuccessStory::orderBy('id','DESC')->get();
        return view('backEnd.success.index',compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.success.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $image = $request->file('image');
        if ($image) {
            // image with intervention
            $name = time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/success/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "";
            $height = "";
            $img->height() > $img->width() ? ($width = null) : ($height = null);
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
        } else {
            $imageUrl = null;
        }

        $input = $request->all();        
        $input['image'] = $imageUrl;
        $input['status'] = $request->status?1:0;
        // dd($input);
        SuccessStory::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('success.index');
    }
    
    public function edit($id)
    {
        $edit_data = SuccessStory::find($id);
        return view('backEnd.success.edit',compact('edit_data'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $update_data = SuccessStory::find($request->hidden_id);
        // return $update_data;
        $input = $request->except('hidden_id');
       
        $image = $request->file('image');
         
        if($image){
            // image with intervention 
            $image = $request->file('image');
            $name =  time().'-'.$image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp',$name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/settings/';
            $imageUrl = $uploadpath.$name; 
            $img=Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = 300;
            $height = 100;
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
            $input['image'] = $imageUrl;
            File::delete($update_data->image);
        }else{
            $input['image'] = $update_data->image;
        }
        

        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('success.index');
    }
 
    public function inactive(Request $request)
    {
        $inactive = SuccessStory::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = SuccessStory::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = SuccessStory::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
