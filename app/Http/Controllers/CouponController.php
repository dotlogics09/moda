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
        $days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];
        return view('admin.coupon.add_coupon', compact('days'));
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
        return $request;die;
        $update_status = Coupon::find($request->coupon_id);
        $update_status->status = $request->status;
        $update_status->save();

        if($update_status){
            return response()->json(["status" => true, 'message' => 'Status Updated Successfully', 'status_text' => $update_status->status], 200);
        }else{
            return response()->json(["status" => false, 'message' => 'Something went Wrong', 'status_text' => ''], 500);
        }
    }

    function edit($id)
    {
        $days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];
        $coupon_edit = Coupon::find($id);
        $selected_days = explode(',', $coupon_edit->days);
        
        return view('admin.coupon.edit_coupon', compact('days', 'coupon_edit', 'selected_days'));
    }

    function update_coupon(Request $request, $id)
    {
        $update_coupon = Coupon::find($id);
        $update_coupon->coupon_title = $request->coupon_title;
        $update_coupon->coupon_code = $request->coupon_code;
        $update_coupon->start_date = $request->start_date;
        $update_coupon->end_date = $request->end_date;
        $update_coupon->use_limit = $request->use_limit;
        $update_coupon->discount_type = $request->discount_type;
        $update_coupon->amount_percentage = $request->amount_percentage;
        $update_coupon->minimum_purc_amt = $request->min_pur_amt;
        $update_coupon->days = implode(',', $request->days);
        $update_coupon->description = $request->description;
        $update_coupon->save();

        return redirect('coupon/coupon_list');
    }

    function delete_coupon(Request $request)
    {
        $delete_coupon = Coupon::find($request->coupon_id);
        $delete_coupon->delete();
        
        if($delete_coupon){
            return response()->json(["status" => true, 'message' => "Record Deleted Successfully"]);
        }else{
            return response()->json(["status" => false, 'message' => "Something went Wrong"]);
        }
    }
}
