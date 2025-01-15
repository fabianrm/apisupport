<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Permission;
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
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'store_id' => 'required|exists:stores,id',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password) || !$user->status) {
            return response()->json(['error' => 'Credenciales inválidas o usuario inactivo'], 401);
        }

        $roleUser = $user->roles()->wherePivot('store_id', $validated['store_id'])->first();

        if (!$roleUser) {
            return response()->json(['error' => 'No tienes acceso a esta tienda'], 403);
        }

        // Filtrar permisos asociados al rol del usuario y construir el menú jerárquico
        $permissions = Permission::with('children')
        ->whereHas('roles', function ($query) use ($roleUser) {
            $query->where('roles.id', $roleUser->id);
        })
        ->where('parent_id', null) // Solo permisos raíz
        ->orderBy('order')
        ->get();

        $token = $user->createToken('userToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'store_id' => $validated['store_id'],
                'role' => $roleUser->name,
            ],
            'permissions' => $permissions, // Menú jerárquico filtrado
        ]);
    }

}
