<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required'],
            'name' => ['required'],
            'description' => [''],
            'type' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'sunat_unit' => ['required'],
            'current_stock' => [''],
            'min_stock' => ['required'],
            'store_id' => ['required'],
            'image' => [''],
            'status' => ['required']
        ];
    }


    /**
     * Mensajes de error personalizados para las validaciones.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.required' => 'El Código es requerido.',
            'code.unique' => 'El Código ya se encuentra registrado.',
            'type.required' => 'El tipo (Producto o Parte) es requerido.',
            'store_id.required' => 'El id de tienda es requerido.',
            

        ];
    }


}
