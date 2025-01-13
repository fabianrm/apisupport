<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'name' => $this->name,
            'ruc' => $this->ruc,
            'location' => $this->location,
            'ubigeo' => $this->ubigeo,
            'department' => $this->department,
            'province' => $this->province,
            'district' => $this->district,
            'urbanization' => $this->urbanization,
            'address' => $this->address,
            'sunat_local_code' => $this->sunat_local_code,
            'phone' => $this->phone,
            'user_id' => $this->user_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }
}
