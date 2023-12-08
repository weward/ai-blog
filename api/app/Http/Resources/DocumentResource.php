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
            'subject' => $this->subject,
            'summary' => $this->summary,
            'bullets' => str_replace('\\n', '<br>', $this->bullets),
            'result' => str_replace('\\n', '<br>', $this->result),
            'created_at' => new DateTimeResource($this->created_at),
            'updated_at' => new DateTimeResource($this->updated_at),
        ];
    }
}
