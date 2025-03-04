<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login'); // Создадим этот шаблон позже
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Неверный email или пароль',
        ])->withInput();
//        return back()->withErrors(['email' => 'Неверный логин или пароль']);
    }

    // Форма регистрации
    public function showRegisterForm() {
        return view('auth.register'); // Создадим этот шаблон позже
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return response()->json(['message' =>  'Регистрация успешна']);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Выход выполнен']);
    }
}
