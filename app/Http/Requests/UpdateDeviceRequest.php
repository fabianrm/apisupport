<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceRequest extends FormRequest
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
                'customer_id' => ['required'],
                'device_type_id' => ['required'],
                'model' => ['required'],
                'serial_number' => ['required'],
                'imei' => ['required'],
                'lock_code' => [],
                'problem_description' => ['required'],
                'store_id' => ['required'],
                'status' => ['required']
            ];
        } else {
            return [
                'customer_id' => ['sometimes', 'required'],
                'device_type_id' => ['sometimes', 'required'],
                'model' => ['sometimes', 'required'],
                'serial_number' => ['sometimes', 'required'],
                'imei' => ['sometimes', 'required'],
                'lock_code' => ['sometimes',],
                'problem_description' => ['sometimes', 'required'],
                'store_id' => ['sometimes', 'required'],
                'status' => ['sometimes', 'required']
            ];
        }
    }
}
