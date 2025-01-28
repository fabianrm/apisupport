<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepairResource extends JsonResource
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
            'code' => $this->code,
            'device' => new DeviceResource($this->whenLoaded('device')),
            'technician' => new UserResource($this->whenLoaded('technician')),
            'store' => new StoreResource($this->whenLoaded('store')),
            'status' => $this->status,
            'total_cost' => $this->total_cost,
            'registered_at' => $this->registered_at,
            'delivery_date' => $this->delivery_date
        ];
    }
}
