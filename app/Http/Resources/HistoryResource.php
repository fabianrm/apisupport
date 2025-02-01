<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            'updated_at' => $this->updated_at,
            'repair_id' => $this->repair_id,
            'comment' => $this->comment,
            'status' => $this->status,
            'changed_by' => $this->whenLoaded('changedBy') ? $this->changedBy->name : null,
            'updated_by' => $this->whenLoaded('updatedBy') ? $this->updatedBy->name : null,
            // 'updated_by' => [
            //     'id' => $this->whenLoaded('updatedBy') ? $this->updatedBy->id : null,
            //     'name' => $this->whenLoaded('updatedBy') ? $this->updatedBy->name : null,
            // ],
        ];
    }
}
