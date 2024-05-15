<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    // function untuk login di aplikasi mobile
    public function login(Request $request)
    {
        try {
            $formField = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
    
            if (auth()->attempt($formField)) {
                $user = User::where('email', $formField['email'])->first();
                $token = $user->createToken('diskoperindag')->plainTextToken;
    
                return response([
                    'user' => $user,
                    'token' => $token,
                ], 201);
            } else {
                return response([
                    'message' => 'Username atau password salah',
                ], 401);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat login'
            ], 500);
        }
    }

    // function untuk logout di aplikasi mobile
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged Out']);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat logout'
            ], 500);
        }
    }

    //function untuk cek token bearer 
    public function checkToken()
    {
        try {
            return response()->json(['message' => 'Token Valid']);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat cek token'
            ], 500);
        }
    }

    //function untuk ganti pasword di aplikasi mobile
    public function changePassword(Request $request)
    {
        try {
            if (Hash::check($request->currentPassword, auth()->user()->password)) {
                $user = auth()->user();
                $user->password = bcrypt($request->newPassword);
                $user->save();

                return response()->json(['message' => 'Password berhasil diubah']);
            } else {
                return response(['message' => 'Invalid current password'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat ganti password'
            ], 500);
        }
    }

    //function untuk memberi fcm token ke user
    public function assignToken(Request $request)
    {
        try {
            $user = auth()->user();
            $user->fcm_token = $request->fcm_token;
    
            if ($user->save()) {
                return response()->json(['message' => 'Token berhasil ditambahkan ke user']);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat assign token'
            ], 500);
        }
    }
}
