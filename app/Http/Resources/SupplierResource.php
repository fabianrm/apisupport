<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ruc'=> $this->ruc,
            'name'=> $this->name,
            'email'=> $this->email,
            'phone'=> $this->phone,
            'address'=> $this->address,
            'status'=> $this->status
        ];
    }
}
