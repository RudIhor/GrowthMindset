<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();

        return $this->respondWithUserAndToken($user, (string)$token);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): JsonResponse
    {
        /** @phpstan-ignore-next-line  */
        return $this->respondWithUserAndToken(auth()->user(), auth()->refresh('main'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @param \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null $user
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithUserAndToken(User|Authenticatable|null $user, string $token): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token,
            'type' => 'bearer',
        ]);
    }
}
