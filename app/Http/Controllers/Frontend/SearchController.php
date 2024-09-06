<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class SearchController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $query = isset($data['query']) ? $data['query'] : '';
        
        // Xử lý tìm kiếm sản phẩm
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
        
        return view('Frontend.Search.search', compact('products'));
    }
    

public function searchPost(Request $request)
{
    $query = Product::query();

    $params = $request->all();

    if (isset($params['name']) && !empty($params['name'])) {
        $query->where('name', 'like', '%' . $params['name'] . '%');
    }
    if (isset($params['price_max']) && !empty($params['price_max'])) {
        $priceRange = explode('-', $params['price_max']);
        $price_min = (int) $priceRange[0]; 
        $price_max = (int) $priceRange[1];  

        $query->whereBetween('price', [$price_min, $price_max]);
    }

    if (isset($params['category']) && !empty($params['category'])) {
        $query->where('id_category', $params['category']);
    }

    if (isset($params['brand']) && !empty($params['brand'])) {
        $query->where('id_brand', $params['brand']);
    }

    if (isset($params['status']) && !empty($params['status'])) {
        $query->where('status', $params['status']);
    }

    if ($query->count() == 0) {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
    } else {
        $products = $query->paginate(10);
    }

    $categories = Category::all();
    $brands = Brand::all();

    return view('Frontend.Product.product', compact('products', 'categories', 'brands'));
}

public function filter(Request $request)
{
     $requestData = $request->all();
     $minPrice = $requestData['min_price'];
     $maxPrice = $requestData['max_price'];
 
     $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();
 
     return response()->json($products);
}


}
