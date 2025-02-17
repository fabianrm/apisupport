<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
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
            'customer_id' => ['required'],
            'device_type_id' => ['required'],
            'model' => ['required'],
            'serial_number' => ['required'],
            'imei' => ['required'],
            'lock_code' => [],
            'problem_description' => ['required'],
            'store_id' => ['required'],
            'status' => ['required'],
        ];
    }
}
