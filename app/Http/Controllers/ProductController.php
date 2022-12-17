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
            ->get();
        
        // return $products;
        // die;
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
            $net_price = $request->price - $request->dicount;
        } else {
            $dicount = $request->discount / 100 * $request->price;
            $net_price = $request->price - $dicount;
        }
        $store_product->net_price = $net_price;
        $store_product->discounted_price = $dicount;
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

        return $store_product;
    }

    function update_status(Request $request)
    {
        $update_status = Product::find($request->product_id);
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
