<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductDetailController extends Controller
{
    public function addToCart(Request $request)
    {
        // Session::forget('cart');
        // dùng để xoá session khi bị lỗi
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found.']);
        }
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }
        Session::put('cart', $cart);
        $totalItems = array_sum(array_column($cart, 'quantity'));
        $cartItems = [];
        // dd($cart);
        // exit;
        foreach ($cart as $id => $details) {
            $cartItems[] = [
                'id' => $id,
                'name' => $details['name'],
                'price' => $details['price'],
                'quantity' => $details['quantity'],
            ];
        }
        return response()->json(['status' => 'success', 'totalItems' => $totalItems, 'cartItems' => $cartItems]);
    }

    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        $totalItems = array_sum(array_column($cart, 'quantity'));

        return response()->json(['totalItems' => $totalItems]);
    }

    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('Frontend.layouts.header', compact('cart'));
    }


//     public function Cart()
// {
//     $cart = Session::get('cart', []);
//     $cartItems = [];
//     foreach ($cart as $id => $details) {
//         $product = Product::find($id); // Lấy thông tin sản phẩm từ DB (đã có trường hinhanh là JSON)
        
//         // Kiểm tra nếu sản phẩm tồn tại và có trường 'hinhanh'
//         if ($product && isset($product->hinhanh)) {
//             $hinhanh = json_decode($product->hinhanh, true); // Giải mã JSON
//             $cartItems[] = [
//                 'id' => $id,
//                 'name' => $details['name'],
//                 'price' => $details['price'],
//                 'quantity' => $details['quantity'],
//                 'hinhanh' => $hinhanh, // Thêm 'hinhanh' vào dữ liệu giỏ hàng
//             ];
//         } else {
//             // Nếu không có trường 'hinhanh', có thể xử lý khác tại đây
//             $cartItems[] = [
//                 'id' => $id,
//                 'name' => $details['name'],
//                 'price' => $details['price'],
//                 'quantity' => $details['quantity'],
//                 'hinhanh' => [], // Hoặc giá trị mặc định nếu không có hình ảnh
//             ];
//         }
//     }
//     return view('Frontend.Product.cart', compact('cartItems'));
// }
}
