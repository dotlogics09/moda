<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('admin.product.product_list', compact('products'));
    }

    function add_product_view()
    {
        return view('admin.product.add_product');
    }
}
