<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon_list', compact('coupons'));
    }

    function add_coupon()
    {
        return view('admin.coupon.add_coupon');
    }

    function store_coupon(Request $request)
    {
        $store_coupon = new Coupon();
        $store_coupon->coupon_title = $request->coupon_title;
        $store_coupon->coupon_code = $request->coupon_code;
        $store_coupon->start_date = $request->start_date;
        $store_coupon->end_date = $request->end_date;
        $store_coupon->use_limit = $request->use_limit;
        $store_coupon->discount_type = $request->discount_type;
        $store_coupon->amount_percentage = $request->amount_percentage;
        $store_coupon->minimum_purc_amt = $request->min_pur_amt;
        $store_coupon->days = implode(',', $request->days);
        $store_coupon->description = $request->description;
        $store_coupon->status = 'active';
        $store_coupon->save();

        return redirect('coupon/coupon_list');
    }

    function update_status(Request $request)
    {
        $update_status = Coupon::find($request->coupon_id);
        $update_status->status = $request->status;
        $update_status->save();

        if($update_status){
            return response()->json(["status" => true, 'message' => 'Status Updated Successfully', 'status_text' => $update_status->status], 200);
        }else{
            return response()->json(["status" => false, 'message' => 'Something went Wrong', 'status_text' => ''], 500);
        }
    }
}
