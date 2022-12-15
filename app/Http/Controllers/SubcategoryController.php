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
        $request->validate([
            'category' => 'required',
            'subcategory_name' => 'required',
            'subcategory_image' => 'required',
        ]);

        $store_subcat = new Subcategory();
        $store_subcat->category_id = $request->category;
        $store_subcat->subcategory_name = $request->subcategory_name;
        if ($request->subcategory_image) {
            $imageName = time() . '.' . $request->subcategory_image->extension();
            $request->subcategory_image->move(public_path('backend/uploads/subcategory'), $imageName);
            $store_subcat->subcategory_image = $imageName;
        }
        $store_subcat->status = 1;
        $store_subcat->save();

        return redirect('subcategory/subcategory_list');
    }

    function subcategory_list()
    {
        $subcat = Subcategory::join('category', 'subcategory.category_id', '=', 'category.id')
        ->select('subcategory.*', 'category.*', 'category.id as cat_id', 'subcategory.id as subcat_id')
        ->get();

        return view('admin.subcategory.subcategory_list', compact('subcat'));
    }

    function update_status(Request $request)
    {
        $update_status = Subcategory::find($request->subcat_id);
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

    function delete_subcategory(Request $request)
    {
        $delete_subcategory = Subcategory::find($request->subcategory_id);
        $delete_subcategory->delete();
        
        if($delete_subcategory){
            return response()->json(["status" => true, 'message' => "Record Deleted Successfully"]);
        }else{
            return response()->json(["status" => false, 'message' => "Something went Wrong"]);
        }
    }

    function edit($id)
    {
        $category = Category::all();
        $edit_data = Subcategory::find($id);
        return view('admin.subcategory.edit_subcategory', compact('edit_data', 'category'));
    }

    function update_subcategory(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'subcategory_name' => 'required',
        ]);

        $store_subcat = Subcategory::find($id);
        $store_subcat->category_id = $request->category;
        $store_subcat->subcategory_name = $request->subcategory_name;
        if ($request->subcategory_image) {
            $imageName = time() . '.' . $request->subcategory_image->extension();
            $request->subcategory_image->move(public_path('backend/uploads/subcategory'), $imageName);
            $store_subcat->subcategory_image = $imageName;
        }
        $store_subcat->status = 1;
        $store_subcat->update();

        return redirect('subcategory/subcategory_list');
    }
}
