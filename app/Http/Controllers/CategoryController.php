<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index()
    {
        return view('admin.add_category');
    }

    function store_category(Request $request)
    {
        return $request;
    }
}
