<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'store' => new StoreSimpleResource($this->whenLoaded('store')),
            'purchase_date' => $this->purchase_date,
            'document' => $this->document,
            'invoice_number' => $this->invoice_number,
            'subtotal' => $this->subtotal,
            'igv' => $this->igv,
            'total' => $this->total,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'status' => $this->status == 1 ? 'activo' : 'suspendido',
            'details' => PurchaseDetailResource::collection($this->whenLoaded('details')),

        ];
    }
}
