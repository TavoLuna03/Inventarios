<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'price'           =>  $this->price,
            'description'     => $this->description,
            'quantity'        => (int) $this->quantity,
            'number_lote'     => (int) $this->number_lote,
            'category_id'     => $this->category_id,
            'expiration_date' => $this->expiration_date,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }

 
}
