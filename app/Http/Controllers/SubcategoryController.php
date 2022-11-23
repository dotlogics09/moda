<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    function index()
    {
        $category = Category::all();
        return view('admin.subcategory.add_subcategory', compact('category'));
    }

    function store_subcategory(Request $request)
    {

    }

    function subcategory_list()
    {
        $subcat = Subcategory::all();
        return view('admin.subcategory.subcategory_list', compact('subcat'));
    }
}
