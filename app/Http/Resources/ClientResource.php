<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Client */
class ClientResource extends JsonResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request),
            [
                'bookings' => BookingResource::collection($this->whenLoaded('bookings'))
            ]
        );
    }
}
