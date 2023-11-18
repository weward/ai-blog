<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'keyword' => $this->keyword,
            'summary' => $this->summary,
            'bullets' => $this->bullets,
            'results' => $this->results,
            'created_at' => $this->created_at->copy()->diffForHumans(),
            'updated_at' => $this->updated_at->copy()->diffForHumans(),
        ];
    }
}
