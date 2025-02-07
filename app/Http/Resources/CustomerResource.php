<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'documentID' => new DocumentIDResource($this->whenLoaded('documentId')),
            'document_number' => $this->document_number,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'store_id' => $this->store_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }

    /**
     * Elimina la palabra "data" de la respuesta {}
     */
    // public function withResponse($request, $response)
    // {
    //     $data = json_decode($response->getContent(), true);
    //     $response->setContent(json_encode($data['data']));
    // }
}
