<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->name,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'device_type_id' => $this->device_type_id,
            'device_type' => new DeviceTypeResource($this->whenLoaded('deviceType')),
            'model' => $this->model,
            'serial_number' => $this->serial_number,
            'imei' => $this->imei,
            'lock_code' => $this->lock_code,
            'problem_description' => $this->problem_description,
            'store_id' => $this->store_id,
            'store_name' => $this->store->name,
            'status' => $this->status,
            'created_by' => $this->creator ? $this->creator->name : null, // Relación con User
            'updated_by' => $this->updater ? $this->updater->name : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
