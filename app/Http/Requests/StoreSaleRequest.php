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
            'sunat_operation_type'=>['required'],
            'sunat_document_type'=>['required'],
            'sunat_payment_method'=>['required'],
            'series'=>['required'],
            'correlative'=>['required'],
            'sunat_currency'=>['required'],
            'mto_oper_gravadas'=>['required'],
            'mto_igv'=>['required'],
            'total_taxes'=>['required'],
            'valor_venta'=>['required'],
            'subtotal'=>['required'],
            'total'=>['required'],
            'issued_at'=>[''],
            'code_legend'=>[''],
            'value_legend'=>[''],
            'active'=>['required'],
            'details' => 'required|array', // Los detalles deben estar presentes
        ];
    }
}
