<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::join('category', 'category.id', '=', 'products.category_id')
            ->join('subcategory', 'subcategory.id', '=', 'products.subcategory_id')
            ->join('users', 'users.id', '=', 'products.created_by')
            ->select('products.*', 'category.*', 'subcategory.*', 'users.*', 'products.id as product_id', 'category.id as cat_id', 'subcategory.id as subcat_id', 'users.id as user_id')
            ->orderBy('products.id', 'Desc')
            ->get();

        return view('admin.product.product_list', compact('products'));
    }

    function add_product_view()
    {
        $category = Category::all();
        return view('admin.product.add_product', compact('category'));
    }

    function get_subcat(Request $request)
    {
        $getsubcat = Subcategory::where('category_id', $request->category_id)->where('status', '1')->get();

        $html = '<option value="" style="display: none;">Select Sub Category</option>';
        foreach ($getsubcat as $subcat) {
            $html .= '<option value="' . $subcat->id . '">' . $subcat->subcategory_name . '</option>';
        }

        if (count($getsubcat) > 0) {
            $data = [
                'status' => true,
                'msg' => 'Data fetched Successfully',
                'data' => $html
            ];
        } else {
            $data = [
                'status' => false,
                'msg' => 'There is no data available....!',
                'data' => ''
            ];
        }

        return $data;
    }

    function store_product(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'price' => 'required',
            'product_description' => 'required'
        ]);

        $store_product = new Product();
        $store_product->product_name = $request->product_name;
        $store_product->category_id = $request->category;
        $store_product->subcategory_id = $request->subcategory;
        $store_product->price = $request->price;
        if ($request->discount_type == 'amount') {
            $net_price = $request->price - $request->discount;
            $discount = $net_price;
        } else {
            $discount = $request->discount / 100 * $request->price;
            $net_price = $request->price - $discount;
        }
        $store_product->net_price = $net_price;
        $store_product->discounted_price = $discount;
        $store_product->discount = $request->discount;
        $store_product->discount_type = $request->discount_type;
        if ($request->product_image) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('backend/uploads/products'), $imageName);
            $store_product->product_image = $imageName;
        }
        $store_product->product_description = $request->product_description;
        $store_product->status = '1';
        $store_product->created_by = session('id');
        $store_product->save();

        return redirect('product/product_list');
    }

    function update_status(Request $request)
    {
        $update_status = Product::find($request->product_id);
        if ($update_status->status == 1) {
            $status = 0;
            $status_text = "Inactive";
        } else {
            $status = 1;
            $status_text = "Active";
        }
        $update_status->status = $status;
        $update_status->save();

        if ($update_status) {
            return response()->json(["status" => true, 'message' => 'Status Updated Successfully', 'status_text' => $status_text], 200);
        } else {
            return response()->json(["status" => false, 'message' => 'Something went Wrong', 'status_text' => ''], 500);
        }
    }

    function edit($id)
    {
        $category = Category::all();
        $edit_data = Product::find($id);
        $subcategory = Subcategory::where('category_id', $edit_data->category_id)->get();
        return view('admin.product.edit_product', compact('edit_data', 'category', 'subcategory'));
    }

    function update_product(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'price' => 'required',
            'product_description' => 'required'
        ]);

        $update_product = Product::find($id);
        $update_product->product_name = $request->product_name;
        $update_product->category_id = $request->category;
        $update_product->subcategory_id = $request->subcategory;
        $update_product->price = $request->price;
        if ($request->discount_type == 'amount') {
            $net_price = $request->price - $request->discount;
            $discount = $net_price;
        } else {
            $discount = $request->discount / 100 * $request->price;
            $net_price = $request->price - $discount;
        }
        $update_product->net_price = $net_price;
        $update_product->discounted_price = $discount;
        $update_product->discount = $request->discount;
        $update_product->discount_type = $request->discount_type;
        if ($request->product_image) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('backend/uploads/products'), $imageName);
            $update_product->product_image = $imageName;
        }
        $update_product->product_description = $request->product_description;
        $update_product->status = '1';
        $update_product->created_by = session('id');
        $update_product->save();

        return redirect('product/product_list');
    }

    function delete_product(Request $request)
    {
        $delete_product = Product::find($request->product_id);
        $delete_product->delete();
        
        if($delete_product){
            return response()->json(["status" => true, 'message' => "Record Deleted Successfully"]);
        }else{
            return response()->json(["status" => false, 'message' => "Something went Wrong"]);
        }
    }
}
