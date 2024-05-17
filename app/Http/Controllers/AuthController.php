<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Credenciais fornecidas são inválidas'], 401);
        }

        $token = auth()->user()->createToken('authToken')->plainTextToken;

        return $this->sendToken($token);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso!']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function refresh(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $token = auth()->user()->createToken('authToken')->plainTextToken;

        return $this->sendToken($token);
    }

    /**
     * Return a Json Response with the token information
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    private function sendToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expiration' => $this->getTokenExpiration()
        ]);
    }

    /**
     * Get Datetime of Token Expiration
     *
     * @return string
     */
    private function getTokenExpiration(): string
    {
        /**
         * Get Sanctum token TTL
         */
        $sanctumExpiration = config('sanctum.expiration');

        /**
         * Create a datetime by sum current time with sanctum expiration config
         */
        $tokenExpiration = Carbon::now()->addMinutes($sanctumExpiration)->toDateTimeString();

        return $tokenExpiration;
    }
}
