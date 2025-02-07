<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'customer_id' => $this->customer_id,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'ubl_version' => $this->ubl_version,
            'sunat_operation_type' => $this->sunat_operation_type,
            'sunat_document_type' => $this->sunat_document_type,
            'sunat_payment_method' => $this->sunat_payment_method,
            'series' => $this->series,
            'correlative' => $this->correlative,
            'sunat_currency' => $this->sunat_currency,
            'mto_oper_gravadas' => $this->mto_oper_gravadas,
            'mto_igv' => $this->mto_igv,
            'total_taxes' => $this->total_taxes,
            'valor_venta' => $this->valor_venta,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'issued_at' => $this->issued_at,
            'code_legend' => $this->code_legend,
            'value_legend' => $this->value_legend,
            'status' => $this->status,
            'hash' => $this->hash,
            'active' => $this->active,
            'details' => SaleDetailResource::collection($this->whenLoaded('details')),
        ];
    }
}
