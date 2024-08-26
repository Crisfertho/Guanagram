<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
   
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show', 'index']),
        ];
    }
    public function index(User $user) 
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(16);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store(Request $request) 
    {
        //Validated
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required', 
            'image' => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth::user()->id,
        ]);

        //Other Way Laravel Style
        /*$request->iser()->posts->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth::user()->id,
        ]);*/

        return redirect()->route('posts.index', auth::user()->username);
    }

    public function show(User $user, Post $post) 
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);    
    }  
    
    public function destroy(Post $post)
    {
        //Gate::allows('delete', $post);
        Gate::authorize('delete',$post);
        $post->delete();

        //Delete image
        $image_path = public_path('uploads/' . $post->image);

        if(File::exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->route('posts.index', auth::user()->username);
    }
}

