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
        $get_cat_data = Category::all();
        
        return view('admin.category.category_list', compact('get_cat_data'));
    }

    function update_status(Request $request)
    {
        $update_status = Category::find($request->cat_id);
        if($update_status->status == 1){
            $status = 0;
            $status_text = "Inactive";
        }else{
            $status = 1;
            $status_text = "Active";
        }
        $update_status->status = $status;
        $update_status->save();

        if($update_status){
            return response()->json(["status" => true, 'message' => 'Status Updated Successfully', 'status_text' => $status_text], 200);
        }else{
            return response()->json(["status" => false, 'message' => 'Something went Wrong', 'status_text' => ''], 500);
        }
    }
}
