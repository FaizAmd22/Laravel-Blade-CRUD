<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Session;
use Hash;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect('posts');
        }

        return view('auth.login');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            var_dump('hehe message');
            return redirect('posts');
        } else {
            var_dump('error message');
            return redirect('login')->with('error_message', 'Wrong email or password');
        }
    }
    
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function register_form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect('login');
    }
    

}
