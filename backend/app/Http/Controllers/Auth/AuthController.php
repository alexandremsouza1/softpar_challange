<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private User $user)
    { }

    public function auth(Request $req): JsonResponse
    {
        $user = User::where('email', '=', $req->email)->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return response()->json(['error' => 'Credenciais inválidas'], 422);
        }
        
        $user->tokens()->delete();
        $token = $user->createToken($user->username . ' - ' . now()->toDateTimeString())->plainTextToken;
        return response()->json(['token' => $token]);
        
    }

    public function me(): JsonResponse
    {
        $user = auth()->user();
        return response()->json($user);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->authAcessToken()->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}