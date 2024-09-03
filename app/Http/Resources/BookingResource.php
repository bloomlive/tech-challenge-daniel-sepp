<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request)
    {
        return array_merge(
            $request->toArray(),
            [
               'start' => Carbon::make($this->resource->start)->format('l d F Y, H:i'),
               'end' => Carbon::make($this->resource->end)->format('l d F Y, H:i'),
            ]
        );
    }
}
