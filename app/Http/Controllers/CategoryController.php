<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    function index()
    {
        return view('admin.category.add_category');
    }

    function store_category(Request $request)
    {
        // return $request;die;
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'required',
        ]);

        $store_cat = new Category();
        $store_cat->category_name = $request->category_name;
        if ($request->category_image) {
            $imageName = time() . '.' . $request->category_image->extension();
            $request->category_image->move(public_path('backend/uploads/category'), $imageName);
            $store_cat->category_image = $imageName;
        }
        $store_cat->status = 1;
        $store_cat->save();

        return redirect('category_list');
    }

    function category_list()
    {
        echo "hello";
        die;
        $get_cat_data = Category::all();

        return view('');
    }
}
