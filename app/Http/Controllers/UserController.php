<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }


    /** Login de Usuario */

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'errors' => 'Credenciales incorrectas.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Obtener al usuario autenticado
        $user = $request->user();

        // Verificar si el usuario tiene el status 1
        if ($user->status !== 1) {
            return response()->json([
                'errors' => 'Tu cuenta está desactivada. Contacta al administrador.'
            ], Response::HTTP_UNAUTHORIZED);
        }

       // $user = $request->user()->load('roles'); // Cargar la relación 'roles'
        //$user = $request->user();
        $userToken = $user->createToken('AppToken')->plainTextToken;

        return response()->json([
            'message' => 'Se ha iniciado sesión correctamente.',
            'token' => $userToken,
            'user' => new UserResource($user)
        ], Response::HTTP_OK);
    }

}
