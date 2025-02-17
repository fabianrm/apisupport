<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreRepairRequest extends FormRequest
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
            'device_id' => 'required|exists:devices,id',
            'technician_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',
            'priority' => 'required|string',
            'assigned_at' => '',
            'resolved_at' => '',
            'delivery_date' => '',
            'closed_at' => '',
            'status' => 'required|string',
            'total_cost' => '',
            'delivery_date' => ''
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
            'device_id.required' => 'Debe seleccionar el dispositivo.',
            'technician_id.required' => 'Debe asignar un técnico.',
        ];
    }
}
