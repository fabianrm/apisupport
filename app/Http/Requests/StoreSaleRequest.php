<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'customer_id'=>['required', 'exists:customers,id'],
            'store_id'=>['required', 'exists:stores,id'],
            'user_id'=>['required', 'exists:users,id'],
            'ubl_version'=>['required'],
            'tipo_operacion'=>['required'],
            'tipo_documento'=>['required'],
            'forma_pago'=>['required'],
            'serie'=>['required'],
            'correlativo'=>['required'],
            'tipo_moneda'=>['required'],
            'mto_oper_gravadas'=>['required'],
            'mto_igv'=>['required'],
            'total_impuestos'=>['required'],
            'valor_venta'=>['required'],
            'subtotal'=>['required'],
            'mto_imp_venta'=>['required'],
            'fecha_emision'=>[''],
            'code_legend'=>[''],
            'value_legend'=>[''],
            'active'=>['required'],
            'details' => 'required|array', // Los detalles deben estar presentes
        ];
    }
}
