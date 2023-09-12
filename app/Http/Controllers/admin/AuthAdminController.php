<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->id_role != 2) {
            return view('admin.login');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    // ĐĂNG NHẬP
    public function login(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'id_role' => 2,
        ];

        $remember_me = $request->has('remember_me') ? true : false;
        if (Auth::attempt($login, $remember_me)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withErrors('Sai email hoặc mật khẩu');
        }
    }

    // ĐĂNG XUẤT
    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
