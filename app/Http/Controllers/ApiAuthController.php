<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
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
                'message' => 'Bad credentials',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json('Logged Out');
    }

    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }

    public function hello(Request $request)
    {
        return response()->json('hello');
    }
}
