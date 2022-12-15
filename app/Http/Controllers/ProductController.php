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
        $products = Product::all();
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
        foreach($getsubcat as $subcat){
            $html .= '<option value="'. $subcat->id .'">'. $subcat->subcategory_name .'</option>';
        }

        if(count($getsubcat) > 0){
            $data = [
                'status' => true,
                'msg' => 'Data fetched Successfully',
                'data' => $html
            ];
        }else{
            $data = [
                'status' => false,
                'msg' => 'There is no data available....!',
                'data' => ''
            ];
        }
        
        return $data;
    }
}
