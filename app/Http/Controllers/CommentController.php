<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class CommentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
    public function store(Request $request, User $user, Post $post) 
    {
       //Validated
       $request->validate([
        'comment' => 'required|max:200',
        ]);

        //Save Comment
        Comment::create([
            'user_id' => auth::user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment
        ]);

        //Print a Message
        return back()->with('message', 'Comment successfully posted');
       
    }
}
