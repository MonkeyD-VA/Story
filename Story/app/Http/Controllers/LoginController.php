<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Xử lý việc đăng nhập

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/story'); // Điều hướng sau khi đăng nhập thành công
        }

        // Xử lý khi đăng nhập không thành công
        // return back()->withErrors([
        //     'email' => 'Invalid credentials',
        // ]);
        return "cant load";
    }
}
