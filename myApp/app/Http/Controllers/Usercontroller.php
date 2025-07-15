<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    public function index() 
    {
       $users = User::with('posts')->get();
        $totalPosts = Post::count();
          return view('users.index', compact('users','totalPosts'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }
                public function makeAdmin($id){
                   $user = User::findOrFail($id);
                   $user->is_admin = true;
                   $user->save();

         return redirect()->back()->with('success', 'تم تعيين المستخدم كأدمن');
              }
              

    public function destroy($id){
              $user = User::findOrFail($id);

     
              if ($user->is_admin) {
                  return redirect()->back()->with('error', 'لا يمكن حذف المستخدم الأدمن');
                 }

                    $user->delete();

               return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
}
    public function userPosts($id){
                       $user = User::with('posts')->findOrFail($id);
                         return view('users.posts', compact('user'                  
                       ));
}

}