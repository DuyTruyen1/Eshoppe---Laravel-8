<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberLoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('Frontend.Member.login',['user' => $user]);
    }

    public function login(MemberLoginRequest $request){
       $login = [
        'email' => $request->email,
        'password' => $request->password,
        'level' => 0
       ];

       $remember = false;

       if($request->remember_me){
        $remember = true;
       }

       if(Auth::attempt($login , $remember)){
        return redirect('/frontend/menu');
       }else{
        return redirect()->back()->withErrors('Email or password is not correct.');
       }
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect('/frontend/login');
    }
}
