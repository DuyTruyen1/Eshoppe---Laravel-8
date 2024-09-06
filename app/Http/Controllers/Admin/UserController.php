<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUsersRequest;
use App\Http\Requests\MemberLoginRequest;

use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('Admin.Users.users', ['user' => $user]);
    }

    public function update(UpdateUsersRequest $request){
        $userId = Auth::id();
    
        // Lấy thông tin của user có id tương ứng
        $user = User::findOrFail($userId);
    
        // Lấy tất cả dữ liệu từ form
        $data = $request->all();
    
        // Kiểm tra nếu có file được upload lên thì xử lý
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
    
            // In ra thông tin của file
            // echo 'Tên Files: ' . $file->getClientOriginalName() . '<br/>';
            // echo 'Đuôi file: ' . $file->getClientOriginalExtension() . '<br/>';
            // echo 'Đường dẫn tạm: ' . $file->getRealPath() . '<br/>';
            // echo 'Kích cỡ file: ' . $file->getSize() . '<br/>';
            // echo 'Kiểu files: ' . $file->getMimeType();
    
            // Lưu tên file vào mảng data
            $data['avatar'] = $file->getClientOriginalName();
    
            $file->move('Admin/upload/user/avatar', $file->getClientOriginalName());
        }
    
        // Kiểm tra nếu có nhập mật khẩu mới
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            // Nếu không có mật khẩu mới, giữ nguyên mật khẩu cũ
            $data['password'] = $user->password;
        }
    
        // Cập nhật thông tin người dùng
        if ($user->update($data)) {
            return redirect()->back()->with('success', __('Update profile success'));
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }
    
}

