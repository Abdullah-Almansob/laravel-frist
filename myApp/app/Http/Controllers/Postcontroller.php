<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class Postcontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }
    // public function __construct()
    public function index(Request $request)
    {
        $query = Post::with('user')->latest();

        // فلترة حسب اسم المستخدم
        if ($request->filled('username')) {
            $username = $request->input('username');
            $query->whereHas('user', function ($q) use ($username) {
                $q->where('name', 'like', '%' . $username . '%');
            });
        }

        // فلترة حسب الفئة (postCategory)
        if ($request->filled('postCategory')) {
            $category = $request->input('postCategory');
            $query->where('postCategory', 'like', '%' . $category . '%');
        }

        $posts = $query->get();

        return view('post.index', compact('posts'));
    }


    // public function index(){
    // $postsFromDB= post::all();      

    // return view('post.index',['posts' => $postsFromDB]);
    //}
    public function show(post $index)
    {

        //$singelpostFromDB= post::findOrfail($id);
        //$singelpostFromDB= post::where('id',$id)->get();
        //dd(
        //post::where('title','php')->get()
        // post::where('title','php')->frist()
        //);  
        //if(is_null($singelpostFromDB)){
        //  return to_route('index');
        //} 
        return view('post.show', ['post' => $index]);
    }
    public function create()
    {

        $Users = user::all();
        return view('post.create', ['users' => $Users]);
    }
    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'postCategory' => ['required', 'string', 'max:50'],
        ]);

        $data = \request()->all();

        $title = \request()->title;
        $description = \request()->description;
        $postCategory = \request()->postCategory; // Assuming you have a postCategory field
        $user_name = \request()->user_name;
        $image = \request()->file('image');
        if ($image) {
            $imagePath = $image->store('images', 'public');
        } else {
            $imagePath = 'images/default_image.png';
        }



        //1-method
        // $post = new post; //create qures in database by post
        //$post->title = $title; //create title by title text 
        //$post->description = $description; //create description by description text 
        //$post->postCategory = $postCategory; // Save the post category
        //$post->user_id = auth()->id(); // Save the user ID
        //$post->save(); //insert into post in database ('t','d')
        //2-method
        post::Create([
            'title' => $title,
            'description' => $description,
            'postCategory' => $postCategory, // Save the post category
            'image_path' => $imagePath,
            'user_id' => auth()->id(),

        ]); //insert into post in database ('t','d')




        return \to_route('post.index'); //rediraction the $post from database to page index(home)
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // تحقق إذا المستخدم هو صاحب البوست أو مشرف
        if (auth()->id() !== $post->user_id && !auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك');
        }

        $users = User::all();
        return view('post.edit', compact('post', 'users'));
    }




    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // تحقق صلاحيات التعديل
        if (auth()->id() !== $post->user_id && !auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;

        if ($request->hasFile('image')) {
            if (
                $post->postImage &&
                $post->postImage !== 'images/default_image.png' &&
                Storage::disk('public')->exists($post->postImage)
            ) {
                Storage::disk('public')->delete($post->postImage);
            }

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $imagePath = $request->image->storeAs('images', $imageName, 'public');
            $post->postImage = $imagePath;
        }

        $post->save();

        return redirect()->route('post.index');
    }


    public function delete($id)
    {

        $post = Post::find($id);



        if (!$post) {
            return redirect()->route('post.index');
        }

        if ($post->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect()->route('post.index');
        }
        $post->delete();

        return redirect()->route('post.index');

        //$post = Post::findOrFail($id);
        //$post->delete();


        //$post=post::find($id);
        //$post->delete();//delet singel post by $id reltionshp with model evevt
        //$post::weher("title","PHP")->delete();//in condation delet all post contain title php from databse

    }
}
