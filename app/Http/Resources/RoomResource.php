<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'id'        => $this->id,
            'number'    => $this->number,
            'capacity'  => $this->capacity,
            'price'     => $this->price/100,
            'floor' => new FloorResource($this->floor)
        ];
    }
}
