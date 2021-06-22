<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use App\Repositories\AuthRepository;
use App\Repositories\UsersRepository;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->repository = new AuthRepository();
        $this->repositoryUser = new UsersRepository();
    }

    public function login()
    {
        $credentials = request(['login', 'password']);

        if ($token = auth('api')->attempt(['login' => $credentials['login'], 'password' => $credentials['password']])) {
            $return = [
                'token' => $this->respondWithToken($token),
                'user' => $this->repositoryUser->getEntity(auth('api')->user()->id),
                'expires_in' => auth('api')->factory()->getTTL(),
            ];

            return response()->json($return);
        }

        return response()->json(
            ['error' => 'Usuario e/ou senha invalidos!'],
            200
        );
    }

    /**
     * Get the authenticated User
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Logout feito com sucesso']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        if ($this->guard()->check()) {
            return $this->respondWithToken(auth('api')->guard()->refresh());
        }

        return response()->json(
            [
                'error' => 'token_invalid',
                'message' => 'Token Válido'
            ],
            401
        );
    }

    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL()
            ]
        );
    }
}
