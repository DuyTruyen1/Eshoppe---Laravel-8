<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class ProductController extends Controller
{
    public function index()
{
    $products = Product::orderBy('created_at', 'desc')->take(6)->get();
    $categories = Category::all();
    $brands = Brand::all();
    
    return response()->json([
        'product' => $products,
        'category' => $categories,
        'brand' => $brands
    ]);
}



public function show($id)
{
    $categories = Category::all();
    $brand = Brand::all();
    $product = Product::findOrFail($id);
    
    $hinhanh = json_decode($product->hinhanh, true);

    return view('Frontend.Product.product-detail', compact('product','hinhanh','categories','brand'));
}    
}
