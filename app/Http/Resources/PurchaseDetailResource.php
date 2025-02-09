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
            'purchase_id' => $this->purchase_id,
            'product' =>  new ProductSimpleResource($this->whenLoaded('product')),
            'store' =>  new StoreSimpleResource($this->whenLoaded('store')),
            'purchase_price' => $this->purchase_price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'remaining_quantity' => $this->remaining_quantity,
            'model' => $this->model,
            'serial' => $this->serial,
            'imei' => $this->imei,
            'color' => $this->color,
            'capacity' => $this->capacity,
            'ubication_detail' => $this->ubication_detail,
            'status' => $this->status,
        ];
    }
}
