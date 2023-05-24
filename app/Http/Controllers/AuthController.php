<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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

        if ($user) {
            $userLogin = $user->role_id;
        } else {
            $userLogin = 4;
        }

        if (($userLogin == 1) || ($userLogin == 2)) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/user')->with('loginberhasil', 'login berhasil');
            } else {
                return redirect()->back()->withInput()->with('loginerror', 'login error');
            }
        } elseif ($userLogin == 3) {
            return redirect()->back()->withInput()->with('bukanadmin', 'login error');
        } elseif ($userLogin == 4) {
            return redirect()->back()->withInput()->with('failed', 'login error');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('logout', 'logout berhasil');
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()],
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'new_password.required' => 'Password baru tidak boleh kosong',
            'old_password.required' => 'Password lama tidak boleh kosong',
            'new_password.min' => 'Password harus lebih dari 8 karakter',
            'new_password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol',
            'new_password_confirmation.required' => 'Konfirmasi password baru tidak boleh kosong',
            'new_password_confirmation.same' => 'Konfirmasi password salah',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('gagalcp', 'Validasi gagal');
        }
    
        $user = Auth::user();
    
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with(['current_password' => 'Password lama salah.']);
        }
    
        $user->password = bcrypt($request->new_password);
        $user->save();
    
        return redirect()->back()->with('cp_succes', 'Password berhasil diubah.');
    }
}
