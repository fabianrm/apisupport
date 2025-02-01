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
            'store' => new StoreSimpleResource($this->whenLoaded('store')),
            'status' => $this->status,
            'priority' => $this->priority,
            'total_cost' => $this->total_cost,
            'assigned_at' => $this->assigned_at,
            'resolved_at' => $this->resolved_at,
            'delivery_date' => $this->delivery_date,
            'updated_at' => $this->updated_at,
            'history' => HistoryResource::collection($this->whenLoaded('history')),
            'files' => RepairFileResource::collection($this->whenLoaded('file')),
        ];
    }
}
