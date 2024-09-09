<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceCar extends JsonResource
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
            'title' => $this->title,
            'year' => $this->year,
            'mileage' => $this->mileage,
            'price' => $this->price,
            'fuel_type' => $this->fuel_type,
            'mechanical_condition' => $this->mechanical_condition,
            'phone' => $this->phone,
            'description' => $this->description,
            'country_id' => $this->country,
            'state_id' => $this->state,
            'city_id' => $this->city,
            'model_id' => $this->model_id,
            'trim_id' => $this->trim_id,
            'body_type' => $this->body_type,
            'regional_specs' => $this->regional_specs,
            'steering_side' => $this->steering_side,
            'is_car_insured' => $this->is_car_insured,
            'view_360_url' => $this->view_360_url,
            'body_condition' => $this->body_condition,
            'exterior_color' => $this->exterior_color,
            'interior_color' => $this->interior_color,
            'warranty' => $this->warranty,
            'cylinders' => $this->cylinders,
            'transmission_type' => $this->transmission_type,
            'seating_capacity' => $this->seating_capacity,
            'horse_power' => $this->horse_power,
            'engine_capacity' => $this->engine_capacity,
            'climate_control' => $this->climate_control,
            'cooled_seats' => $this->cooled_seats,
            'dvd_player' => $this->dvd_player,
            'front_wheel_drive' => $this->front_wheel_drive,
            'keyless_entry' => $this->keyless_entry,
            'leather_seats' => $this->leather_seats,
            'navigation_system' => $this->navigation_system,
            'parking_sensors' => $this->parking_sensors,
            'premium_sound_system' => $this->premium_sound_system,
            'rear_view_camera' => $this->rear_view_camera,
            'doors' => $this->doors,
            'purpose' => $this->purpose,
            'image' => asset('storage/images/cars/'.$this->image),
            'created_at' => $this->created_at->format('d F, Y H:i'),
            'updated_at' => $this->updated_at->format('d F, Y H:i'),
        ];
    }
}
