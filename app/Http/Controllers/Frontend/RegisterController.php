<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        return view('Frontend.Member.register',['user' => $user]);
    }

    public function register(Request $request)
    {
        // Lấy tất cả dữ liệu từ yêu cầu
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
    
        // Chuyển hướng sau khi đăng ký thành công
        return redirect()->route('frontend.register')->with('success', 'User registered successfully!');
    }
    

    
    


    
    


    


}
