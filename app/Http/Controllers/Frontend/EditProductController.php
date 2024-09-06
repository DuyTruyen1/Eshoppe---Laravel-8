<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class EditProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Frontend.Product.edit-product');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('Frontend.Product.edit-product', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function updateProduct(UpdateProductRequest $request, $id)
{
    // Kiểm tra sản phẩm tồn tại
    $product = Product::find($id);
    if (!$product) {
        return back()->with('error', 'Product not found.');
    }

    // Xác thực dữ liệu
    $validatedData = $request->validated();

    // Xử lý ảnh mới
    $images = [];
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            $name = $file->getClientOriginalName();
            $path = public_path('upload/product/' . $name);
            $path2 = public_path('upload/product/hinh50_' . $name);
            $path3 = public_path('upload/product/hinh200_' . $name);

            Image::make($file)->save($path);
            Image::make($file)->resize(50, 70)->save($path2);
            Image::make($file)->resize(200, 300)->save($path3);

            $images[] = $name;
        }
    }

    if ($request->has('delete_images')) {
        $deleteImages = $request->delete_images;
        $productImages = json_decode($product->hinhanh, true) ?? [];

        foreach ($deleteImages as $deleteImage) {
            $index = array_search($deleteImage, $productImages);
            if ($index !== false) {
                unset($productImages[$index]);
            }
        }

        $product->hinhanh = json_encode(array_values($productImages));
    }

    $product->update([
        'name' => $validatedData['name'],
        'price' => $validatedData['price'],
        'id_category' => $validatedData['category_id'],
        'id_brand' => $validatedData['brand_id'],
        'status' => $validatedData['status'],
        'sale' => $validatedData['sale'],
        'company' => $validatedData['company'],
        'detail' => $validatedData['detail'],
    ]);

    if (!empty($images)) {
        $totalImages = count(json_decode($product->hinhanh, true) ?? []) + count($images);
        if ($totalImages <= 3) {
            $product->hinhanh = json_encode(array_merge(json_decode($product->hinhanh, true) ?? [], $images));
        } else {
            return back()->with('error', 'Maximum 3 images allowed.');
        }
    }

    if ($product->save()) {
        return back()->with('success', 'Product updated successfully.');
    } else {
        return back()->with('error', 'Failed to update product.');
    }
}





    public function delete($id = 0){
        $title = 'Xóa Sản Phẩm';
        $msg = '';
        if(!empty($id)){
            $product = Product::find($id);
            if($product){
               $deleteStatus = $product->delete(); // Xóa cầu thủ
               if($deleteStatus){
                return back()->with('success', 'Product deleted successfully.');
            }else{
                $msg = 'Không thể xoá ';
               }
            }else{
               $msg = 'ID Sản Phẩm không tồn tại';
            }
        } else {
            $msg = 'ID Sản Phẩm không hợp lệ ';
        }
    }
}
