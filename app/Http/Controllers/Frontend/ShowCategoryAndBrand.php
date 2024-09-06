<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class ShowCategoryAndBrand extends Controller
{
    public function index()
    {
        // Lấy tất cả các category và brand từ cơ sở dữ liệu
        $categories = Category::all();
        $brands = Brand::all();

        // Truyền dữ liệu vào view
        return view('Frontend.layouts.menu-left',  [
            'categories' => $categories,
            'brand' => $brands
        ]);
    }
}
