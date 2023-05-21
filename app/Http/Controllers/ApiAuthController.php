<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function checkToken()
    {
        return response()->json("Valid");
    }

    public function changePassword(Request $request)
    {
        if (Hash::check($request->currentPassword, auth()->user()->password)) {
            $user = auth()->user();
            $user->password = bcrypt($request->newPassword);

            return response()->json($user->save());
        } else {
            return response(status: 403);
        }
    }
}
