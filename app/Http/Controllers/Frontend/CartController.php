<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            
            if ($product && isset($product->hinhanh)) {
                $hinhanh = json_decode($product->hinhanh, true); // Giải mã JSON
                $cartItems[] = [
                    'id' => $id,
                    'name' => $details['name'],
                    'price' => $details['price'],
                    'quantity' => $details['quantity'],
                    'hinhanh' => $hinhanh, // Thêm 'hinhanh' vào dữ liệu giỏ hàng
                ];
            } 
        }
        return view('Frontend.Product.cart')->with('cartItems', $cartItems);
    }  
    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $action = $request->input('action', 'update'); // Mặc định action là 'update'
        $cart = session()->get('cart', []);
    
        $product = Product::find($productId);
    
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found']);
        }
    
        switch ($action) {
            case 'increase':
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity']++;
                }
                break;
            case 'decrease':
                if (isset($cart[$productId]) && $cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']--;
                }
                break;
            case 'remove':
                unset($cart[$productId]);
                break;
            case 'update':
                if ($quantity == 0) {
                    unset($cart[$productId]);
                } elseif (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] = $quantity;
                }
                break;
            default:
                return response()->json(['status' => 'error', 'message' => 'Invalid action']);
        }
    
        // Lưu lại giỏ hàng vào session
        session()->put('cart', $cart);
    
        // Tính lại tổng giá trị của giỏ hàng
        $totalCartPrice = 0;
        foreach ($cart as $item) {
            $totalItemPrice = $item['price'] * $item['quantity'];
            $totalCartPrice += $totalItemPrice;
        }
    
        // Trả về response JSON với các thông tin cập nhật
        return response()->json([
            'status' => 'success',
            'id' => $productId, // Trả về id sản phẩm đã cập nhật
            'totalItemPrice' => isset($cart[$productId]) ? $cart[$productId]['quantity'] * $product->price : 0, // Tính lại giá trị sản phẩm đã cập nhật
            'totalPrice' => $totalCartPrice
        ]);
    }
    
    
}
