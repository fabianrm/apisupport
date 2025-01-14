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
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'device_type' => new DeviceTypeResource($this->whenLoaded('deviceType')),
            'model' => $this->model,
            'serial_number' => $this->serial_number,
            'imei' => $this->imei,
            'lock_code' => $this->lock_code,
            'problem_description' => $this->problem_description,
            'store_id' => $this->store_id,
            'status' => $this->status
        ];
    }
}
