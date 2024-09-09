<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceTrim extends JsonResource
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
            'trims' => $this->trims,
            'brand_id' => $this->brands,
            'model_id' => $this->models,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d F, Y H:i'),
            'updated_at' => $this->updated_at->format('d F, Y H:i'),
            // Add more attributes as needed
        ];
    }
}
