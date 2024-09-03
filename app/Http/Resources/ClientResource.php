<?php

namespace App\Http\Resources;

use App\Client;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Client */
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
