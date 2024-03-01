<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    //

    public function register(Request $request) {
        return $request;
    }
    public function login(Request $request) {
        // return $request;
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $attempt = Auth::attempt($credentials);

        if (!$attempt) {
            return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken($user->name)->plainTextToken;

        $user = Auth::user();
        $response = [
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ];
        return $this->sendResponse($response, 'User login success');
    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();

        return response()->json(['message' => 'You have logged out']);
    }
}
