<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'ruc' => ['required'],
            'location' => ['required'],
            'ubigeo' => ['required'],
            'department' => ['required'],
            'province' => ['required'],
            'district' => ['required'],
            'urbanization' => ['required'],
            'address' => ['required'],
            'sunat_local_code' => ['required'],
            'phone' => ['required'],
            'user_id' => ['required'],
        ];
    }
}
