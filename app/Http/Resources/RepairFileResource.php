<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepairFileResource extends JsonResource
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
            'updated_at' =>  $this->updated_at,
            'updated_by' => $this->whenLoaded('updatedBy') ? $this->updatedBy->name : null,
            // 'updated_by' => [
            // 'file_path' => $this->file_path,
            'file_path' => asset('storage/' . $this->file_path),
            'store_id' => $this->store_id,
        ];
    }
}
