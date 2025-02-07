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
            'unit'=>'required',
            'quantity'=>'required',
            'unit_value'=>'required',
            'description'=>'required',
            'base_igv'=>'required',
            'percentage_igv'=>'required',
            'igv'=>'required',
            'tax_affected_code'=>'required',
            'total_taxes'=>'required',
            'value_sale'=>'required',
            'unit_price'=>'required'
        ];
    }
}
