<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DateTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($date): array
    {
        return [
            'orig' => $this->resource,
            'short' => $this->short(),
            'long' => $this->long(),
            'human' => $this->human(),
        ];
    }

    private function short()
    {
        return $this->resource->copy()->format('m/d/Y');
    }

    private function long()
    {
        return $this->resource->copy()->format('F d, Y G:i A');
    }

    private function human()
    {
        return $this->resource->copy()->diffForHumans();
    }
}
