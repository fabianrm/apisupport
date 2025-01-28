<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return new UserCollection($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function filterTechnicians(Request $request)
    {
        // Validar el parámetro 'store_id'
        $validated = $request->validate([
            'store_id' => 'required|integer|exists:stores,id', // Ajusta el nombre de la tabla si es diferente
        ]);

        $storeId = $validated['store_id'];

        // Obtener usuarios cuyo rol sea 'admin' y coincidan con el store_id
        $users = User::whereHas('roles', function ($query) use ($storeId) {
            $query->where('name', 'technician')
            ->where('role_user.store_id', $storeId); // Especifica la tabla pivote explícitamente
        })->with('roles')->get();

        // Retornar como UserCollection
        return new UserCollection($users);
    }

}
