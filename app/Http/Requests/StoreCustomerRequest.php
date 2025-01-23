<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required'],
            'document_type' => ['required', Rule::in(['dni', 'ruc', 'ce'])],
            'document_number' => ['required', 'unique:customers'],
            'email' => ['required', 'email', 'unique:customers'],
            'phone' => [''],
            'address' => [''],
            'store_id' => ['required'],
            'status' => ['required'],
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
            'document_number.unique' => 'El Documento ya se encuentra registrado.',
            'email.unique' => 'El email ya se encuentra registrado.',
            'store_id.required' => 'El id de tienda es requerido.',
            
        ];
    }

}
