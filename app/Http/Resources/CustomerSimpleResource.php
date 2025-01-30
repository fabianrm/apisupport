<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerSimpleResource extends JsonResource
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
            'document_type' => $this->document_type,
            'document_number' => $this->document_number,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ];
    }
}
