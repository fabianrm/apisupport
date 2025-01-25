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
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'category_id' => $this->category_id,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'brand_id' =>  $this->brand_id,
            'brand' =>  new BrandResource($this->whenLoaded('brand')),
            'sunat_unit' =>  $this->sunat_unit,
            'unit' =>  new SunatUnitResource($this->whenLoaded('sunatUnit')),
            'current_stock' => $this->current_stock,
            'min_stock' => $this->min_stock,
            'store_id' => $this->store_id,
            'image' => asset('storage/' . $this->image),
            'status' => $this->status
        ];
    }
}
