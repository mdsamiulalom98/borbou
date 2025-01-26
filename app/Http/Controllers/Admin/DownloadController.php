<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use Toastr;

class DownloadController extends Controller
{
    
    public function index(Request $request){
        $show_data = OrderDetails::latest();
        if($request->start_date && $request->end_date){
            $show_data = $show_data->whereBetween('created_at',[$request->start_date, $request->end_date]);
        }
        $show_data = $show_data->get();
        return view('backEnd.download.index',compact('show_data'));
    }
}
