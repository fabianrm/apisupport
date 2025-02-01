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

class AuthController extends Controller
{


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

        // Obtener permisos y filtrar los hijos
        $permissions = Permission::select('id', 'name', 'description', 'icon', 'route', 'parent_id', 'order', 'status')
            ->with(['children' => function ($query) use ($roleUser) {
                $query->select('id', 'name', 'description', 'icon', 'route', 'parent_id', 'order', 'status')
                    ->whereHas('roles', function ($subQuery) use ($roleUser) {
                        $subQuery->where('roles.id', $roleUser->id);
                    });
            }])
            ->whereHas('roles', function ($query) use ($roleUser) {
                $query->where('roles.id', $roleUser->id);
            })
            ->where('parent_id', null)
            ->orderBy('order')
            ->get();

        // Filtrar los permisos que no tienen hijos y convertir a array
        // $filteredPermissions = $permissions->filter(function ($permission) {
        //     return $permission->children->isNotEmpty();
        // })->values(); // El método values() reindexará el array numéricamente

        // Ya no filtramos los permisos sin hijos
        $filteredPermissions = $permissions->values();

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
            'permissions' => $filteredPermissions, // Ahora será un array sin índices personalizados
        ]);
    }
    
    //Refresh Token

    public function refreshToken(Request $request)
    {
        $user = $request->user(); // Obtiene al usuario autenticado mediante el token actual
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
        // Log::info($user);

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
