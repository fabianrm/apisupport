<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        //     if (!Auth::attempt($request->validated())) {
        //         return response()->json([
        //             'errors' => 'Credenciales incorrectas.'
        //         ], Response::HTTP_UNAUTHORIZED);
        //     }

        //     // Obtener al usuario autenticado
        //     $user = $request->user();

        //     // Verificar si el usuario tiene el status 1
        //     if ($user->status !== 1) {
        //         return response()->json([
        //             'errors' => 'Tu cuenta está desactivada. Contacta al administrador.'
        //         ], Response::HTTP_UNAUTHORIZED);
        //     }

        //    // $user = $request->user()->load('roles'); // Cargar la relación 'roles'
        //     //$user = $request->user();
        //     $userToken = $user->createToken('AppToken')->plainTextToken;

        //     return response()->json([
        //         'message' => 'Se ha iniciado sesión correctamente.',
        //         'token' => $userToken,
        //         'user' => new UserResource($user)
        //     ], Response::HTTP_OK);
        // }

        // Validar las credenciales
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'store_id' => 'required|exists:stores,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Obtener el usuario por correo
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas.'], 401);
        }

        // Verificar el estado del usuario
        if (!$user->status) {
            return response()->json(['error' => 'El usuario está inactivo.'], 403);
        }

        // Verificar si el usuario tiene el rol asociado a la tienda
        $roleUser = $user->roles()->wherePivot('store_id', $request->store_id)->first();

        if (!$roleUser) {
            return response()->json(['error' => 'No tienes acceso a esta tienda.'], 403);
        }

        // Generar token de inicio de sesión
        $token = $user->createToken('auth_token')->plainTextToken;

        // Cargar permisos asociados al rol y la tienda
        $permissions = $roleUser->permissions()->pluck('name');

        return response()->json([
            'message' => 'Inicio de sesión exitoso.',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'store_id' => $request->store_id,
                'role' => $roleUser->name,
                'permissions' => $permissions,
            ],
        ], 200);
    }

}
