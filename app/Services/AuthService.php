<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(Request $request): JsonResponse
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid login request',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        return $this->responseToken($user);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return $this->responseToken($user);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
                'trace' => $ex->getTrace()
            ]);
        }
    }

    private function responseToken(User $user): JsonResponse
    {
        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken('auth')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }
}