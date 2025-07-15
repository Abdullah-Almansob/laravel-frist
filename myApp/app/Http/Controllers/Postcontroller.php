<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class Postcontroller extends Controller
{
    public function index(Request $request)
{
    $query = Post::with('user')->latest();

    if ($request->filled('username')) {
        $username = $request->input('username');
        $query->whereHas('user', function ($q) use ($username) {
            $q->where('name', 'like', '%' . $username . '%');
        });
    }

    $posts = $query->get();

    return view('post.index', compact('posts'));
}

   // public function index(){
       // $postsFromDB= post::all();      
       
       // return view('post.index',['posts' => $postsFromDB]);
    //}
    public function show(post $index){

        //$singelpostFromDB= post::findOrfail($id);
        //$singelpostFromDB= post::where('id',$id)->get();
        //dd(
            //post::where('title','php')->get()
           // post::where('title','php')->frist()
        //);  
        //if(is_null($singelpostFromDB)){
          //  return to_route('index');
        //} 
    return view('post.show',['post' => $index]);
    }
    public function create(){
       
        $Users=user::all();          
        return view('post.create',['users'=>$Users]);
    }
    public function store(){
        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:10']
         ]);
        
        $data= \request()->all();
       
        $title= \request()->title;
        $description = \request()->description;
        $user_name=\request()->user_name;
        $image=\request()->file('image');
        if ($image) {
            $imagePath = $image->store('images', 'public');
        } else {
            $imagePath = 'images/default_image.png'; }

            

//1-method
        //$post= new post; //create qures in database by post
       // $post->title =$title;//create title by title text 
        //$post->description=$description;//create description by description text 
        //$post->save();//insert into post in database ('t','d')
//2-method
        post::Create([
            'title'=>$title,
            'description'=>$description,
            'image_path'=>$imagePath,
            'user_id' => Auth::id(),
        ]);
       
        return \to_route('post.index');//rediraction the $post from database to page index(home)
    }
    public function edit(Post $id){
        
        $Users=user::all();
        return view('post.edit', ['users'=> $Users
        ,'post'=>$id
    ]);
   
    }

    public function update($id){
        
        $title = request()->title;
        $description = request()->description;
        $user_name=\request()->user_name;
               
        $image = request()->file('image');
    
        $singelpostFromDB = Post::findOrFail($id);
        
    
      
        if ($image) {
           
            if (
                $singelpostFromDB->image_path &&
                $singelpostFromDB->image_path !== 'images/default_image.png' &&  // انتبه للمسار الكامل
                Storage::disk('public')->exists($singelpostFromDB->image_path)
            ) {
                Storage::disk('public')->delete($singelpostFromDB->image_path);
            }
    
            
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public'); // output: images/172354738.png
    
           
            $singelpostFromDB->image_path = $imagePath;
        }
        $singelpostFromDB->title = $title;
        $singelpostFromDB->description = $description;
        $singelpostFromDB->user_id=$user_name; 
        $singelpostFromDB->save();
    
       
        return \to_route('post.show',$id);
        
    }
    public function delete($id){
       
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