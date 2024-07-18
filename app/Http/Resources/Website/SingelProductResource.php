<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingelProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'id' => $this->id,
            'name' => $this->name,
            'price'=> $this->price,
            'offer_price'=> $this->offer_price,
            'code'=>$this->code,
            'offer'=>$this->offer,
            'category'=>$this->category,
            'size'=>$this->sizes,
            'images'=>$this->images,
            'colores'=>$this->colors,
        ];
    }
}
