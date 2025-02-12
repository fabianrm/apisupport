<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'capacity' => $this->capacity,
            'color' => $this->color,
            'id' => $this->id,
            'imei' => $this->imei,
            'model' => $this->model,
            'product' =>  new ProductSimpleResource($this->whenLoaded('product')),
            'purchase_price' => $this->purchase_price,
            'quantity' => $this->quantity,
            'remaining_quantity' => $this->remaining_quantity,
            'sale_price' => $this->sale_price,
            'serial' => $this->serial,
            'status' => $this->status,
            'store' =>  new StoreSimpleResource($this->whenLoaded('store')),
            'ubication_detail' => $this->ubication_detail,
        ];
    }
}
