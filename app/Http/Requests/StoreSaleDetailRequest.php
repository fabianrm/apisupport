<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleDetailRequest extends FormRequest
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
            'sale_id'=> 'required|exists:sales,id',
            'purchase_detail_id'=>'required|exists:purchase_details,id',
            'cantidad'=>'required',
            'mto_valor_unit'=>'required',
            'mto_base_igv'=>'required',
            'porcentaje_igv'=>'required',
            'igv'=>'required',
            'tip_afe_igv'=>'required',
            'total_impuestos'=>'required',
            'mto_valor_venta'=>'required',
            'mto_precio_unit'=>'required',
            'store_id'=>'required',
        ];
    }
}
