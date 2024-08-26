<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
    public function index() 
    {
        return view('profile.index');
    }

    public function store(Request $request) 
    {
        //Modificated Request
        $request->request->add(['username' => Str::slug($request -> username)]);

        //Validated
        $request->validate([
            'username' => ['required','unique:users,username,'.Auth::user()->id, 'min:4', 'max:18','not_in:editprofile'],
            'email' => ['required','unique:users,email,'.Auth::user()->id,'max:30'],
            'password_confirm' => ['required'] // Validar que el campo de confirmación de contraseña no esté vacío
    
        ]);

        //Obtener el usuario autenticado
        $user = User::find(Auth::user()->id);

         // Verificar la confirmación de la contraseña
        if (!Hash::check($request->password_confirm, Auth::user()->password)) {
            return back()->withErrors([
                'password_confirm' => 'Incorrect Password',
            ])->withInput();
        }

         // Manejo de cambio de contraseña (si se seleccionó)
        if ($request->has('change_password')) {
            $request->validate([
                'oldpassword' => 'required',
                'password' => 'required|confirmed',
            ]);

            if (!Hash::check($request->oldpassword, Auth::user()->password)) {
                return back()->withErrors([
                    'oldpassword' => 'Incorrect Password',
                ])->withInput();
            }

            $user->password = Hash::make($request->password);
            $user->save();

            // Desconectar al usuario y redirigir a la página de login
            Auth::logout();
            return redirect()->route('login')->with('status', 'Password changed successfully. Please log in again.');
        }

        if($request->image) {
            $image = $request->file('image');
            $nameImage = Str::uuid() . "." . $image->extension();

            $manager = new ImageManager(new Driver());
    
            $imageServer = $manager::imagick()->read($image);
            $imageServer->cover(1000,1000);
    
            $imagePath = public_path('profiles') . '/' . $nameImage;
            $imageServer->save($imagePath);
 
        }

        //Save Image 
        $user->username = $request->username;
        $user->image = $nameImage ?? auth::user()->image ?? null;
        $user->email = $request->email;
        $user->save();

        //redirect
        return redirect()->route('posts.index',$user->username);

    }
}
