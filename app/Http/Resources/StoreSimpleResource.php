<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreSimpleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'ruc' => $this->ruc,
            'address' => [
                'street' => $this->address,
                'department' => $this->department,
                'province' => $this->province,
                'district' => $this->district,
            ],
            'image' => asset('storage/' . $this->image),
            "user_id" => $this->user_id,
        ];
    }
}
