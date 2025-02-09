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
            'id' => $this->id,
            'ubl_version' => $this->ubl_version,
            'store' => new StoreSimpleResource($this->whenLoaded('store')),
            'tipo_operacion' =>  new OperationTypeResource($this->whenLoaded('operationType')),
            'tipo_documento' => new DocumentTypeResource($this->whenLoaded('documentType')),
            'forma_pago' => new PaymentMethodResource($this->whenLoaded('paymentMethod')),
            'user_id' => $this->user_id,
            'cliente' => new CustomerSimpleResource($this->whenLoaded('customer')),
            'serie' => $this->serie,
            'correlativo' => $this->correlativo,
            'tipo_moneda' => new CurrencyResource($this->whenLoaded('currency')),
            'mto_oper_gravadas' => $this->mto_oper_gravadas,
            'mto_igv' => $this->mto_igv,
            'total_impuestos' => $this->total_impuestos,
            'valor_venta' => $this->valor_venta,
            'subtotal' => $this->subtotal,
            'mto_imp_venta' => $this->mto_imp_venta,
            'fecha_emision' => $this->fecha_emision,
            'code_legend' => $this->code_legend,
            'value_legend' => $this->value_legend,
            'estado' => $this->estado,
            'hash' => $this->hash,
            'active' => $this->active,
            'details' => SaleDetailResource::collection($this->whenLoaded('details')),
        ];
    }
}
