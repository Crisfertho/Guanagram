<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function index () {
        return view('auth.register');
    }

    public function store (Request $request) {
        
        //Modificated Request
        $request->request->add(['username' => Str::slug($request -> username)]);

        //Validated
        $validate = $request->validate([
            'name' => 'required|min:4',
            'username' => 'required|unique:users|min:4|max:18',
            'email' => 'required|unique:users|email|max:30',
            'password' => 'required|confirmed|min:6'
        
        ]);

        User::create([
            'name' => $validate["name"],
            'username' =>$validate["username"],
            'email' => $validate["email"],
            'password' => $validate["password"]
        ]);

        //Authenticate
        auth::attempt($request->only('email', 'password'));

        //Redirect
        return redirect()->route('posts.index');
    }
}
