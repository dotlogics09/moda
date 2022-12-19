<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    function index()
    {
        return view('admin.coupon.coupon_list');
    }
}
