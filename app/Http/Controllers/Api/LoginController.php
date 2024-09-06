<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\api\LoginRequest;
use App\Http\Requests\api\MemberRequest;
use Intervention\Image\Facades\Image as Image;
use App\Models\User;

class LoginController extends Controller
{
    public $successStatus = 200;

    public function login(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }
        
        if ($this->doLogin($login, $remember)){
            $user = Auth::user();
            // $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'success' => 'success',
                // 'token' => $token,
                'Auth' => $user
            ], $this->successStatus);
        } else {
            return response()->json([
                'response' => 'error',
                'errors' => ['errors' => 'invalid email or password'],
            ], $this->successStatus);
        }
    }
    
    protected function doLogin($attempt, $remember)
    {
        
        if (Auth::attempt($attempt, $remember)) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect('/frontend/login');
    }
}
