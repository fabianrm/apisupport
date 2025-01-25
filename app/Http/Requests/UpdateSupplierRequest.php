<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
                'ruc' => ['required'],
                'name' => ['required'],
                'email' => ['email'],
                'phone' => [''],
                'address' => [''],
                'store_id' => ['required'],
                'status' => ['required']
            ];
        } else {
            return [
                'ruc' => ['sometimes', 'required'],
                'name' => ['sometimes', 'required'],
                'email' => ['sometimes', 'email', 'unique:suppliers'],
                'phone' => ['sometimes', ''],
                'address' => ['sometimes', ''],
                'store_id' => ['required'],
                'status' => ['sometimes', 'required']
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
            'ruc.unique' => 'El Documento ya se encuentra registrado.',
            'email.unique' => 'El email ya se encuentra registrado.',
            'store_id.required' => 'El id de tienda es requerido.',

        ];
    }
}
