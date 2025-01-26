<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PaymentDetails;
use App\Models\User;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['locked','unlocked']);
    }
    public function dashboard(Request $request)
    {
        $total_order = Order::count();
        $today_order = OrderDetails::where('created_at', '>=', Carbon::today())->count();
        $total_member = Member::count();
        $latest_member = Member::latest()->limit(5)->get();
        $today_delivery = Order::where(['order_status' => 'Completed'])->where('created_at', '>=', Carbon::today())->count();
        $total_delivery = Order::where(['order_status' => 'Completed'])->count();
        $last_week_download = OrderDetails::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $last_week = Order::where(['order_status' => 'Completed'])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $last_month = Order::where(['order_status' => 'Completed'])->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $last_month_download = OrderDetails::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $monthly_sale = Order::select(DB::raw('DATE(created_at) as date', 'created_at'))
            ->selectRaw("SUM(amount) as amount")
            ->where(['order_status' => 'Completed']);

        if ($request->has('start_date') && $request->has('end_date')) {
            $monthly_sale->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $monthly_sale = $monthly_sale->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();
            
        $monthly_payment = PaymentDetails::select(DB::raw('DATE(created_at) as date', 'created_at'))
            ->selectRaw("SUM(amount) as amount")
            ->whereNotNull('transaction_id');

        if ($request->has('start_date') && $request->has('end_date')) {
            $monthly_payment->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $monthly_payment = $monthly_payment->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();

        $today_download = OrderDetails::where('created_at', '>=', Carbon::today())->latest()->with('visitor')->get();
        return view('backEnd.admin.dashboard', compact('total_order', 'today_order', 'total_member', 'latest_member', 'today_delivery', 'total_delivery', 'last_week', 'last_week_download', 'last_month', 'last_month_download', 'monthly_sale', 'today_download', 'monthly_payment'));
    }
    public function changepassword()
    {
        return view('backEnd.admin.changepassword');
    }
    public function newpassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required_with:new_password|same:new_password|'
        ]);

        $user = User::find(Auth::id());
        $hashPass = $user->password;

        if (Hash::check($request->old_password, $hashPass)) {

            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            Toastr::success('Success', 'Password changed successfully!');
            return redirect()->route('dashboard');
        } else {
            Toastr::error('Failed', 'Old password not match!');
            return back();
        }
    }
    public function locked()
    {
        // only if user is logged in

        Session::put('locked', true);
        return view('backEnd.auth.locked');


        return redirect()->route('login');
    }

    public function unlocked(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('login');
        $password = $request->password;
        if (Hash::check($password, Auth::user()->password)) {
            Session::forget('locked');
            Toastr::success('Success', 'You are logged in successfully!');
            return redirect()->route('dashboard');
        }
        Toastr::error('Failed', 'Your password not match!');
        return back();
    }
}
