<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        // $permissions = Permission::with('children')
        // ->whereHas('roles', function ($query) use ($roleUser) {
        //     $query->where('roles.id', $roleUser->id);
        // })
        // ->where('parent_id', null) // Solo permisos raíz
        // ->orderBy('order')
        // ->get();

        $permissions = Permission::select('id', 'name', 'description', 'icon', 'route', 'parent_id', 'order', 'status')
            ->with(['children' => function ($query) {
                $query->select('id', 'name', 'description', 'icon', 'route', 'parent_id', 'order', 'status');
            }])
            ->whereHas('roles', function ($query) use ($roleUser) {
                $query->where('roles.id', $roleUser->id);
            })
            ->where('parent_id', null)
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


    //Refresh Token

    public function refreshToken(Request $request)
    {
        $user = $request->user(); // Obtiene al usuario autenticado mediante el token actual

        Log::info($user);

        if (!$user) {
            return response()->json(['error' => 'Token inválido o usuario no autenticado'], 401);
        }

        // Opcional: Revoca todos los tokens antiguos del usuario
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        // Crear un nuevo token
        $newToken = $user->createToken('userToken')->plainTextToken;

        // Cargar el store_id desde la relación roleUser
        $storeId = $user->roleUser->store_id ?? null;


        return response()->json([
            'message' => 'Token refrescado exitosamente',
            'token' => $newToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'store_id' => $storeId,
            ]
        ]);
    }


    public function checkToken(Request $request)
    {

        // Obtener el token desde el encabezado de autorización
        $token = $request->bearerToken();

        // Obtener al usuario autenticado
        $user = auth()->user();
        Log::info($user);

        if ($user) {
            return response()->json(
                [
                    'message' => 'Token válido',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'token' => $token,
                ],
                200
            );
        }

        return response()->json(
            [
                'statusCode' => '401',
                'message' => 'No existe Token',
                'error' => 'Unauthorized'
            ],
            401
        );
    }
}
