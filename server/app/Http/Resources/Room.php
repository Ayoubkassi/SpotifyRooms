<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Room extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'code' => $this->code,
            'number_of_votes' => $this->number_of_votes,
            'host' => $this->host,
            'created_at' => $this->created_at->format('d/m/Y'),

        ];
    }
}
