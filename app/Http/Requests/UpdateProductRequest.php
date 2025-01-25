<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules(): array
    {
        $method = $this->method();
        if ($method === "PUT") {
            return [
                'code' => ['required'],
                'name' => ['required'],
                'description' => ['required'],
                'type' => ['required'],
                'category_id' => ['required'],
                'brand_id' => ['required'],
                'sunat_unit' => ['required'],
                'current_stock' => ['required'],
                'min_stock' => ['required'],
                'store_id' => ['required'],
                'image' => [''],
                'status' => ['required']
            ];
        } else {
            return [
                'code' => ['sometimes','required'],
                'name' => ['sometimes','required'],
                'description' => ['sometimes','required'],
                'type' => ['sometimes','required'],
                'category_id' => ['sometimes','required'],
                'brand_id' => ['sometimes','required'],
                'sunat_unit' => ['sometimes','required'],
                'current_stock' => ['sometimes','required'],
                'min_stock' => ['sometimes','required'],
                'store_id' => ['sometimes','required'],
                'image' => ['sometimes',''],
                'status' => ['sometimes','required']
            ];
        }
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
