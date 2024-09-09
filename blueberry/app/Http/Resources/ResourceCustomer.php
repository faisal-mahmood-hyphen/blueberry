<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceCustomer extends JsonResource
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
            'role' => $this->role,
            'name' => $this->name,
            'image' => asset('storage/images/cars/'.$this->image),
            'dob' => $this->dob,
            'email' => $this->email,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d F, Y H:i'),
            'updated_at' => $this->updated_at->format('d F, Y H:i'),
            // Add more attributes as needed
        ];
    }
}
