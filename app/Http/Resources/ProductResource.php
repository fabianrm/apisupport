<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'brand' =>  new BrandResource($this->whenLoaded('brand')),
            'sunat_unit' =>  new SunatUnitResource($this->whenLoaded('sunatUnit')),
            'current_stock' => $this->current_stock,
            'min_stock' => $this->min_stock,
            'image' => $this->image,
            'status' => $this->status
        ];
    }
}
