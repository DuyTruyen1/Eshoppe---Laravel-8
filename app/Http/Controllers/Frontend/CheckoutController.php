<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\History;
use App\Models\User;

use Illuminate\Support\Facades\Session;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

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
        return view('Frontend.Checkout.checkout')->with('cartItems', $cartItems);
    }


    public function submitOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = session()->get('cart', []);
        $totalCartPrice = array_reduce($cartItems, function ($carry, $item) {
            return $carry + $item['price'] * $item['quantity'];
        }, 0);

        $data = [
            'subject' => 'Order Confirmation',
            'body' => 'Here are the details of your recent order:',
            'user' => $user,
            'cartItems' => $cartItems,
            'totalCartPrice' => $totalCartPrice
        ];

        try {
            Mail::to($user->email)->send(new MailNotify($data));
            $this->processOrder($user);
            return response()->json(['message' => 'Hãy kiểm tra Email của bạn để biết chi tiết đơn hàng !']);
        } catch (\Exception $th) {
            return response()->json(['message' => 'Xin lỗi , đã xảy ra lỗi !']);
        }
    }

    public function processOrder($user)
{
    $cartItems = session()->get('cart', []);
    $totalCartPrice = array_reduce($cartItems, function ($carry, $item) {
        return $carry + $item['price'] * $item['quantity'];
    }, 0);

    $history = new History();
    $history->email = $user->email;
    $history->phone = $user->phone;
    $history->name = $user->name;
    $history->id_user = $user->id;
    $history->price = $totalCartPrice;
    $history->save();

    $data = [
        'subject' => 'Order Confirmation',
        'body' => 'Here are the details of your recent order:',
        'user' => $user,
        'cartItems' => $cartItems,
        'totalCartPrice' => $totalCartPrice
    ];

    try {
        Mail::to($user->email)->send(new MailNotify($data));
        return response()->json(['message' => 'Great, check your mailbox for order details']);
    } catch (\Exception $th) {
        return response()->json(['message' => 'Sorry, something went wrong']);
    }
}


    public function updateCartCheckout(Request $request)
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

    public function registerOder(Request $request)
    {
        $data = $request->all();
    
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatarName = $file->getClientOriginalName();
            $file->move(public_path('Frontend/upload/user/avatar'), $avatarName); 
            $data['avatar'] = 'Frontend/upload/user/avatar/' . $avatarName;
        }
    
        // Kiểm tra và mã hóa mật khẩu mới nếu có
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
    
        $user = new User($data);
        $user->level = 0;
    
        $user->save();
        $this->processOrder($user);
        return redirect()->route('frontend.register')->with('success', 'User registered successfully!');
    }
}
