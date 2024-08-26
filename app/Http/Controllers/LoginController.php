<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request) {
        
    //Validated
        /*$validate = $request->validate([
           'email' => 'required|email',
            'password' => 'required'
        
        ]);

        if(!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('message', 'Incorrect Credentials');
    }*/

    // Validación de los datos
    $request->validate([
        'login' => 'required', // 'login' puede ser correo o nombre de usuario
        'password' => 'required',
    ]);

    // Intentar autenticación con correo
    $credentials = $request->only('password');
    
    if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
        // Si el 'login' es un correo, autenticar usando 'email'
        $credentials['email'] = $request->login;
    } else {
        // De lo contrario, usar 'username'
        $credentials['username'] = $request->login;
    }

    // Intentar la autenticación
    if (!Auth::attempt($credentials, $request->remember)) {
        return back()->with('message', 'Incorrect Credentials');
        }

        //Reset Password
        

        //Redirect
        return redirect()->route('posts.index', auth::user()->username);
    }
}
