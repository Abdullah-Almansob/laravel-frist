<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // عرض نموذج التسجيل
    public function showForm()
    {
        return view('auth.register');
    }

    // تنفيذ التسجيل
    public function register(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // إنشاء المستخدم
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // توجيه المستخدم
        return redirect()->route('login')->with('success', 'تم إنشاء الحساب بنجاح! يمكنك تسجيل الدخول الآن.');
    }
}
