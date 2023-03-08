<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if($user){
            $userLogin = $user->role_id;
        } else{
            $userLogin = 3;
        }
        
        if($userLogin == 1){
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                Session::flash('status','success');
                Session::flash('message', 'Selamat anda berhasil login sebagai admin!');

                return redirect()->intended('/user');
            }
            Session::flash('status','failed');
            Session::flash('message', 'Login gagal!');
    
            return back();
        } elseif($userLogin == 2){
            Session::flash('status','failed');
            Session::flash('message', 'Maaf hanya admin yang boleh masuk!');
    
            return back();
        } elseif($userLogin ==3){
            Session::flash('status','failed');
            Session::flash('message', 'Login gagal!');
    
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
