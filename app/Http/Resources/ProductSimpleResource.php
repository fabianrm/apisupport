<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSimpleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'name'=>$this->name,
            'description'=>$this->description,
            'type'=>$this->type,
            'sunat_unit'=>$this->sunat_unit,
            'current_stock'=>$this->current_stock,
            'store_id'=>$this->store_id,
            'status'=>$this->status,
        ];
    }
}
