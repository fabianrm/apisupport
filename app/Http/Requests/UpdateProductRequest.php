<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateProductRequest extends FormRequest
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

    // public function rules(): array
    // {
    //     return [
    //         'code' => ['required', 'string'],
    //         'name' => ['required', 'string'],
    //         'description' => ['nullable', 'string'],
    //         'type' => ['required', 'string'],
    //         'category_id' => ['required', 'integer'],
    //         'brand_id' => ['required', 'integer'],
    //         'sunat_unit' => ['required', 'string'],
    //         'min_stock' => ['required', 'integer'],
    //         'store_id' => ['required', 'integer'],
    //         'status' => ['required', 'boolean'], // Verifica que Angular envíe 0 o 1 como booleano
    //         'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    //     ];
    // }
     
    public function rules(): array
    {
        $method = $this->method();
        if ($method === "PUT") {
            return [
                'code' => ['required', 'string'],
                'name' => ['required', 'string'],
                'description' => ['nullable', 'string'],
                'type' => ['required', 'string'],
                'category_id' => ['required', 'integer'],
                'brand_id' => ['required', 'integer'],
                'sunat_unit' => ['required', 'string'],
                'current_stock' => ['nullable', 'numeric'],
                'min_stock' => ['required', 'integer'],
                'store_id' => ['required', 'integer'],
                'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'status' => ['required', 'boolean' ]
            ];
        }

        return [
            'code' => ['sometimes', 'required', 'string'],
            'name' => ['sometimes', 'required', 'string'],
            'description' => ['nullable', 'string'],
            'type' => ['sometimes', 'required', 'string'],
            'category_id' => ['sometimes', 'required', 'integer'],
            'brand_id' => ['sometimes', 'required', 'integer'],
            'sunat_unit' => ['sometimes', 'required', 'string'],
            'current_stock' => ['sometimes', 'nullable', 'numeric'],
            'min_stock' => ['sometimes', 'required', 'integer'],
            'store_id' => ['sometimes', 'required', 'integer'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'status' => ['sometimes', 'required', 'boolean']
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
            'type.required' => 'El tipo (Producto o Parte) es requerido.',
            'store_id.required' => 'El id de tienda es requerido.',
        ];
    }


}
