<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el parámetro 'q' de la query string
        $searchQuery = $request->input('q');
        
        // Construir la consulta base
        $query = Customer::query();

        // Aplicar filtro por nombre si existe el parámetro 'q'
        if ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        }

        // Obtener los resultados
        $customers = $query->get();
        $customers->load('documentId');

        // Retornar la colección
        return new CustomerCollection($customers);

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
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return new CustomerResource($customer);
        // return new CustomerResource(Customer::create($request->all()));

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer->load('documentId');
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->deleteOrFail();

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Cliente eliminado correctamente'
            ]
        ]);
    }
    /**
     * Borrado logico de un cliente
     */

    public function deactivate(Customer $customer)
    {
        // Cambiar el estado a "false" (desactivado)
        $customer->update(['status' => false]);

        // Retornar una respuesta JSON indicando éxito
        return response()->json([
            'message' => 'Cliente desactivado exitosamente.',
            'customer' => new CustomerResource($customer)
        ], 200);
    }
    


}
