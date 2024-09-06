<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;


class AddProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('Frontend.Product.add-product');
    }

    public function showCategoryAndBrand()
    {
        // Retrieve all categories
        $categories = Category::all();
        
        // Retrieve all brands
        $brand = Brand::all();

        // Pass categories and brands to the view
        return view('Frontend.Product.add-product', [
            'categories' => $categories,
            'brand' => $brand
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [];
    
        // Kiểm tra xem có file nào được upload hay không
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $image = Image::make($file);
                $name = $file->getClientOriginalName();
                $name_2 = "hinh50_" . $file->getClientOriginalName();
                $name_3 = "hinh200_" . $file->getClientOriginalName();
                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name_2);
                $path3 = public_path('upload/product/' . $name_3);
                
                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);
                $data[] = $name;
            }
        } else {
            dd("No files found.");
        }
    
        $product = Product::create([
            'id_user' => $user->id,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'id_category' => $request->input('category_id'),
            'id_brand' => $request->input('brand_id'),
            'status' => $request->input('status'),
            'sale' => $request->input('sale'),
            'sale_price' => $request->input('sale_price'),
            'company' => $request->input('company'),
            'hinhanh' => json_encode($data),
            'detail' => $request->input('detail')
        ]);
    
        return back()->with('success', 'Your images have been successfully uploaded.');
    }


    public function create()
{
    // Lấy tất cả sản phẩm từ cơ sở dữ liệu
    $products = Product::all();

    return view('Frontend.Product.product', compact('products'));
}


    

}
