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
        // تحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // إنشاء مستخدم جديد
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);

        // رفع الصورة إن وُجدت
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        $user->save();

        // (اختياري) تسجيل الدخول للمستخدم مباشرة بعد التسجيل
        // auth()->login($user);
        return redirect()->route('login')->with('success', 'تم إنشاء الحساب بنجاح! يمكنك تسجيل الدخول الآن.');
    }
}
