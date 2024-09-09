<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceBrand extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'image' => asset('storage/images/brands/'.$this->image),
            'created_at' => $this->created_at->format('d F, Y H:i'),
            'updated_at' => $this->updated_at->format('d F, Y H:i'),
            // Add more attributes as needed
        ];
    }
}
